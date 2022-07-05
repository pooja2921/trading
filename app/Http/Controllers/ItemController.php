<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemImage;
use Auth;
use DataTables;
use App\Models\Attribute;
use App\Models\ItemDetail;
use File;
use App\Models\Product;
use App\Models\Tanent;
use App\Models\Measurement;
use App\Models\Country;
use App\Models\ProductCategory;
use App\Models\Day;

class ItemController extends Controller
{

    public function __construct(Item $items,Category $category,ItemImage $itemimages,Attribute $attribute,ItemDetail $itemdetail,Product $products)
    {
        $this->items=$items;
        $this->products=$products;
        $this->category=$category;
        $this->itemimages=$itemimages;
        $this->attribute=$attribute;
        $this->itemdetail=$itemdetail;
        //parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return  $request;
        //$this->items->get();
        if($request->name!=''){
             $items= $this->products->where('name','like', '%'.$request->name.'%')->select('id','name','image','brand','product_code')->orderBy('created_at','DESC')->paginate(10); 
        }
        else{
             $items= $this->products->select('id','name','image','brand','product_code')->where('id', '!=', 0)->orderBy('created_at','DESC')->paginate(10);
        }
        return view('items.items',compact('items'));
    }

    public function itemsearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = $this->items->where('name','like', '%'.$query.'%')->select('id','name','available','price')->get();
        }
        return response()->json($searchcategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getitemlist(){

        $data = Item::get();
        $hasManageUser = Auth::user()->can('manage_user');

        return Datatables::of($data)
            
            ->addColumn('action', function ($data) use ($hasManageUser) {
                $output = '';
                if ($data->name == 'Super Admin') {
                    return '';
                }
                //if ($hasManageUser) {
                    $output = '<div class="table-actions">
                                <a href="' . url('items/' . $data->id. '/edit/') . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('items/delete/' . $data->id) . '"  ><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                //}

                return $output;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
    public function create()
    {
        /*$category= $this->category->whereNull('parent_id')->select('id','name','slug')->get();*/
        $categories=Category::whereNull('parent_id')->select('id','name')->get();
        $measurements = Measurement::get();
        $countries=Country::get();
        $days=Day::get();
        return view('items.create',compact('categories','measurements','countries','days'))->with('products',$this->products);
    }

    public function getchildcat(Request $request){
        //return $request;
        
         $category =Category::where('parent_id',$request->id)->select('id','name')->get();
        return $category;
        // return \Response::json(['status'=>'success', 'message'=>'category selected successfully.', 'data'=> $category]);
    }

    public function catsearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = Category::whereNull('parent_id')->where('name','like', '%'.$query.'%')->select('id','name')->get();
        }
        return response()->json($searchcategory);
    }

    public function getsubcat(Request $request){
        //return $request;
        $category =$this->category->whereIN('parent_id',$request->id)->select('id','name','slug')->get();
        return $category;
    }

    public function getsubchildcat($id){
        //return $id;
        $category =$this->category->where('parent_id',$id)->select('id','name','slug')->get();
        return $category;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
            $tanents=Tanent::where('id','1')->select('id')->first();
            if(isset($request->file))
            {

                $image = $request->file('file');
                $fileInfo = $image->getClientOriginalName();
                $uniqueId= time().mt_rand();

                $filename = $uniqueId;
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $file_name= $filename.'.'.$extension;
                $image->move('images\upload\item/',$file_name);
                $request['image']= $file_name;
            }
           
            $request['company_id']=$tanents->id;
            $request['user_id']=auth()->user()->id;

            $request['name']=ucfirst(strtolower(trans($request->name)));
            
            
               //return $request;
            if($request->brand !=''){
                $request['brand']=ucfirst(strtolower(trans($request->brand)));
            }

            $lastfetch=Product::select('id')->orderBy('created_at','DESC')->first();
            
            $productCode1 = "PR00000";
            if($lastfetch->id==NULL)
            {
                 $productCode2 = 1;
                
            }
            else
            {
               $productCode2 = $lastfetch->id + 1;
            }
            $productCode2 = $lastfetch->id + 1;
            $productCode = $productCode1.$productCode2;
            $request['product_code']=$productCode;


             $item=$this->products->create($request->except(['_token','file','itemimages','attribute','quantity','price','sku','filepath','sale_price','variant','available','productcategory_id','product_group_id','product_category_id','sub_category_id']));

             if(isset($request['sub_category_id'])){
                for($i = 0; $i< count($request['sub_category_id']); $i++)
                {
                    $category['product_id'] = $item->id;
                    $category['product_group_id'] = $request['product_group_id'];
                    $category['product_category_id'] = $request['product_category_id'][$i];
                    $category['sub_category_id'] = $request['sub_category_id'][$i];
                    //return $category;
                    ProductCategory::create($category);
                }
            
            }

            \Session::flash('success', 'Sucessfully inserted item');
           
            return redirect()->route('items.index');
    }

    
    public  function files($file){
        //return $file;
                $image = $file;
                $fileInfo = $image->getClientOriginalName();
                $uniqueId= time().mt_rand();

                $filename = $uniqueId;
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $file_name= $filename.'.'.$extension;
                $image->move('images\upload\itemthumbnail/',$file_name);
                //$request['image']= $file_name;
                return $data['image'] = $file_name;
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items=Product::with('category','productcategory')->find($id);
        $measurements = Measurement::get();
        $countries=Country::get();
        //$items= $this->items->with('category','itemdetail','subcategory','childcategory','imagedetail','itemdetailvariant')->find($id);

        $selected_tags = array();
        $parentcat = array();
        $subcat = array();
        foreach ($items->productcategory as $post_tag) {
            array_push($selected_tags, $post_tag->product_group_id);
            array_push($parentcat, $post_tag->product_category_id);
            array_push($subcat, $post_tag->sub_category_id);
        }
        //return $selected_tags;
         $category= Category::whereNull('parent_id')->select('id','name')->get();
         $categories=Category::whereNull('parent_id')->select('id','name')->where('depth','0')->get();
        $procategories=Category::where('parent_id','!=','')->where('depth','1')->get();
        $subcategories=Category::where('parent_id','!=','')->where('depth','2')->get();
        $days=Day::get();
        /*$childcategory= $this->category->whereNotNull('parent_id')->orwhere('parent_id','!=',0)->select('id','name')->get();*/
        //$attribute = $this->attribute->get();
        return view('items.edit',compact('category','items','measurements','countries','categories','procategories','subcategories','selected_tags','parentcat','subcat','days'))->with('items',$items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request;

        if(isset($request->file))
            {

                 $image = $request->file('file');
                $fileInfo = $image->getClientOriginalName();
                $uniqueId= time().mt_rand();

                $filename = $uniqueId;
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $file_name= $filename.'.'.$extension;
                $image->move('images\upload\item/',$file_name);
                $request['image']= $file_name;
            }

            $request['name']=ucfirst(strtolower(trans($request->name)));
                //return $request;
            if($request->brand !=''){
                $request['brand']=ucfirst(strtolower(trans($request->brand)));
            }
            $item=Product::where('id',$id)->update($request->except(['_token','_method','file','childcategory_id','product_group_id','product_category_id','sub_category_id']));

             
            if(isset($request['sub_category_id'])){

                ProductCategory::where('product_id',$id)->delete();

                for($i = 0; $i< count($request['sub_category_id']); $i++)
                {
                    $category['product_id'] = $id;
                    $category['product_group_id'] = $request['product_group_id'];
                    $category['product_category_id'] = $request['product_category_id'][$i];
                    $category['sub_category_id'] = $request['sub_category_id'][$i];
                    //return $category;
                    ProductCategory::create($category);
                }
            
            }

            \Session::flash('success', 'Sucessfully updated item');
            return redirect()->route('items.index');
    }

    public function itemdelete($id){
        //return $id;
        $items = Product::find($id);
        $image_path = public_path("images\upload\items/".$items->image);  // Value is not URL but directory file path
        if (file_exists($image_path)) {

           @unlink($image_path);

        }
         $items = Product::where('id',$id)->forceDelete();
         
        return \Response::json(['status'=>'success', 'message'=>'items deleted successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteimg($id){
        //return $id;
        try{
            $item = $this->items->find($id);
            $image_path = public_path("images\upload\category/".$item->image);  // Value is not URL but directory file path
        if (file_exists($image_path)) {

           @unlink($image_path);

        }
         $dell = $this->items->where('id', $id)->where('image', 'like', $item->image)->first();
        $dell->update(['image' => null]);
            return \Response::json(["status"=>"success", "message"=> 'Image delete successfully!']);
        }
        catch (\Exception $e)
        {
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }
    }
}
