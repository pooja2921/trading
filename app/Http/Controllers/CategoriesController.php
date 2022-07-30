<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use validator;
use App\Http\Requests\CategoryRequest;
use App\ControllerHelpers\BaumHelper;
use auth;
use App\ControllerHelpers\GeneralHelper;

class CategoriesController extends Controller
{

    public function __construct(Category $category)
    {
        $this->category=$category;
        //parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
            //return $request;
            if($request->search!=''){
                $parentcategory = $this->category->where('name','like', '%'.$request->search.'%')->select('id','name')->orderBy('created_at','DESC')->paginate(10);
            }
            else{
                 $parentcategory = $this->category->whereNull('parent_id')->orwhere('parent_id',0)->with('children')->select('id','name','parent_id')->orderBy('created_at','DESC')->paginate(10);
            }
             $allcategory = $this->category->whereNull('parent_id')->orwhere('parent_id',0)->with('children')->select('id','name','parent_id')->get();
                
                return view('inventory.category.index',compact('parentcategory','allcategory'))->with('category',$this->category);
        }
        catch (Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function autocompletesearch(Request $request){
       
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = $this->category->where('name','like', '%'.$query.'%')->select('id','name')->get();
        }
        return response()->json($searchcategory);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        try
        {
          
            
                    $cate_data['parent_id'] = null;
                
                    $cate_data['name'] = ucwords($request['name']);
                    //$cate_data['slug'] = $request['slug'];
                    
                    //return $cate_data;
                    /*$cat=$this->category->where('name',$request->name)->first();
                    if($cat==''){*/

                            $category = $this->category->create($cate_data);
                             
                            if($request->parent_id == null || $request->parent_id == 0){

                                 $category->makeRoot();
                            } else{
                                 $category->makeChildOf($request->parent_id);
                            }
                            \Session::flash('success', ' Sucessfully inserted your data');
                        /*}
                    else{
                        \Session::flash('success', 'Already inserted category');  
                    }*/
                

            
            return redirect()->route('categories.index');
        }
        catch (Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
        
    }

    public function storecat(Request $request)
    {
        //return $request->all();
        try
        {
          
            
                    $cate_data['parent_id'] = $request['parent_id'];
                
                    $cate_data['name'] = ucwords($request['name']);
                    //$cate_data['slug'] = $request['slug'];
                    
                    //return $cate_data;
                    /*$cat=$this->category->where('name',$request->name)->first();
                    if($cat==''){*/

                            $category = $this->category->create($cate_data);
                             
                            if($request->parent_id == null || $request->parent_id == 0){

                                 $category->makeRoot();
                            } else{
                                 $category->makeChildOf($request->parent_id);
                            }
                            \Session::flash('success', ' Sucessfully inserted your data');
                        /*}*/
                    /*else{
                        \Session::flash('success', 'Already inserted category');  
                    }*/
                

            
            return redirect()->back();
        }
        catch (Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function CategoryAdd($request)
    {
        //return $request['file'];
        $data=[];
        
        $data['user_id'] = auth()->user()->id;

        return $data;

    }
    public function show($id)
    {
        //return $id;
        $parentcategory =$this->category->where('id',$id)->select('id','name','parent_id')->first();
        $parentname= $this->category->where('id',$parentcategory->parent_id)->select('id','name')->first();
        $category =$this->category->whereNotNull('parent_id')->where('depth','1')->get();
        $selectcategory =$this->category->where('parent_id',$id)->where('depth','1')->get();
         return view('inventory.category.show',compact('parentcategory','category','parentname','selectcategory'));
    }

    public function showchild($id)
    {
        //return $id;
        $parentcategory =$this->category->where('id',$id)->select('id','name','parent_id')->first();
        $parentname= $this->category->where('id',$parentcategory->parent_id)->select('id','name')->first();
        $category =$this->category->where('parent_id',$id)->get();
         return view('inventory.category.showchild',compact('parentcategory','category','parentname'));
    }

    public function categorydetail($id)
    {
        //return $id;
        $category =$this->category->where('id',$id)->first();
         
         return \Response::json(['status'=>"success", 'message'=>'category show  successfully.', 'category'=>$category]);
    }

    public function search(Request $request)
    {
        //return $request;
        
        if($request->name!=''){
            $selectcategory =$this->category->where('name','like', '%'.$request->name.'%')->where('depth','1')->get();
            $category = $this->category->where('name','like', '%'.$request->name.'%')->where('depth','2')->get();
            $parentcategory =$this->category->where('id',$selectcategory[0]['parent_id'])->select('id','name')->first();
        }
        
        
         return view('inventory.category.show',compact('parentcategory','category','selectcategory'));
    }

     public function searchchild(Request $request)
    {
        //return $request;
        
        if($request->search!=''){

            $category = $this->category->where('name','like', '%'.$request->search.'%')->where('depth','2')->get();
             $parentcategory =$this->category->where('id',$category[0]['parent_id'])->select('id','name')->first();
        }
        
        
         return view('inventory.category.showchild',compact('parentcategory','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            //return $id;
            $category =$this->category->where('id',$id)->first();
            $parentcategory = $this->category->select('id','name','type')->whereNull('parent_id')->get();
           
            
           return \Response::json(['status'=>"success", 'message'=>'attributes edit successfully.', 'category'=>$category,'parentcategory'=>$parentcategory]);
        }
        catch (Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function editsubcat($id)
    {
       //return $id;
       try
        {
            //return $id;
            $category =$this->category->where('id',$id)->first();
            //$parentcategory = $this->category->select('id','name','type')->whereNotNull('parent_id')->where('depth','1')->get();
            $parentcategory = $this->category->select('id','name','type')->whereNotNull('parent_id')->where('id',$category->parent_id)->get();
           
            
           return \Response::json(['status'=>"success", 'message'=>'attributes edit successfully.', 'category'=>$category,'parentcategory'=>$parentcategory]);
        }
        catch (Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updatecategory(Request $request){
       //return $request;

                $cate_data['parent_id'] = null;

                $cate_data['name'] = ucwords($request['name']);
                  //return $cate_data;  
                $category = $this->category->where('id',$request->id)->update($cate_data);
                    
                    $category = $this->category->find($request->id);
                    if($request->parent_id != $category->parent_id){
                        if($request->parent_id == null || $request->parent_id == 0){
                         $category->makeRoot();
                    } else{
                         $category->makeChildOf($request->parent_id);
                    }
                }
                
                return redirect()->back();
    }

    public function updatecat(Request $request){
       //return $request;

                $cate_data['parent_id'] = $request['parent_id'];

                $cate_data['name'] = ucwords($request['name']);
                  //return $cate_data;  
                 $category = $this->category->where('id',$request->id)->update($cate_data);
                    
                        
                
                
                return redirect()->back();
    }



    public function subcategory(Request $request){
        //return $request;
        if(isset($request->image))
        {

                $image = $request->file('image');
                $fileInfo = $image->getClientOriginalName();
                $uniqueId= time().mt_rand();

                $filename = $uniqueId;
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $file_name= $filename.'.'.$extension;
                $image->move('images\upload\category/',$file_name);
                $cate_data['image']= $file_name;
            }
             
        

                $cate_data['parent_id'] = $request['parent_id'];
                $singlename = GeneralHelper::replaceStringAndExplode($request['name']);

                foreach($singlename as $k => $categoryname)
                {
                    $cate_data['name'] = $request['name'];
                    //$cate_data['slug'] = $categoryname;
                    $cate_data['type']=ucfirst($request['type']);
                    //$cate_data['user_id'] = auth()->user()->id;
                    //return $cate_data;
                    $category = $this->category->where('id',$request->id)->update($cate_data);
                    // return $request->parent_id;
                    $category = $this->category->find($request->id);
                    if($request->parent_id != $category->parent_id){
                        if($request->parent_id == null || $request->parent_id == 0){
                         $category->makeRoot();
                    } else{
                         $category->makeChildOf($request->parent_id);
                    }
                }
                }
                return redirect()->back();
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function categorydelete($id){
        //return $id;
        $category = $this->category->find($id);
        $image_path = public_path("images\upload\category/".$category->image);  // Value is not URL but directory file path
        if (file_exists($image_path)) {

           @unlink($image_path);

        }
         $category = $this->category->where('id',$id)->forceDelete();

        return \Response::json(['status'=>'success', 'message'=>'category deleted successfully.']);

    }
    public function destroy($id)
    {
        //
    }

    public function getSelectedCategory(Request $request){
        try
        {
            // return 'demo';
            // return $request->all();
            $allcategories = [];
            $parentcategory = $this->category->where('parent_id',null)->where('type', $request->type)->get();
            if(isset($parentcategory)){
                foreach($parentcategory as $categories)
                {
                    $allcategories[]= $categories->getDescendantsAndSelf();
                }
                return $allcategories ;
            }
            else
            {
                return $allcategories ;
            }
        }
        catch(\Exception $e)
        {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

   
}
