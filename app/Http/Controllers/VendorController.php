<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Models\Category;
use App\Models\Tanent;
use Validator;
use App\Models\VendorCategory;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
             $vendors = Vendor::where('first_name','like', '%'.$request->search.'%')->paginate(10);
        }
        else{
            $vendors = Vendor::where('id', '!=', 0)->orderBy('created_at','DESC')->paginate(10);
        }
        return view('partner.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states=State::get();
        $cities=City::get();
        $countries=Country::get();
        $categories=Category::whereNull('parent_id')->get();
        $procategories=Category::where('parent_id','!=','')->where('depth','1')->get();
        $subcategories=Category::where('parent_id','!=','')->where('depth','2')->get();
        return view('partner.create',compact('states','cities','countries','categories','procategories','subcategories'));
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

         // return $request['product_category_id'];
     //return json_decode($request['prduct_group_data']);
        //$collection = collect(json_decode($request['prduct_group_data']));
      // $finaldata = $collection->whereIn('id', $request['product_category_id']);
      //return json_encode($finaldata);
        //return $this->getgroup($request['prduct_group_data'],$request['product_category_id']);
        try{
            if($request->clientType=='Registered' || $request->clientType=='Registered-Composite'){
                $validator = Validator::make($request->all(), [
                'first_name'=>'required',
                'email' => 'required|unique:vendors',
                'mobile' => 'required|unique:vendors',
                'gst_number' => 'required|unique:vendors',
                ]);
            }
            else{
                
                $validator = Validator::make($request->all(), [
                        'first_name'=>'required',
                        'email' => 'required|unique:vendors',
                        'mobile' => 'required|unique:vendors',
                    ]);
            }

            if ($validator->fails()) {
                return redirect('vendor/create')
                        ->withErrors($validator)
                        ->withInput();
            }

            $request['first_name']=ucfirst($request->first_name);
            if($request->middle_name!=''){
            $request['middle_name']=ucfirst(trans($request->middle_name));
            }
            
            //return $request->last_name;
            if($request->last_name=='NA'){
             //return 'gnghg';
                $request['last_name']='';
               
            }
            else if($request->last_name!="NA" || "Na" || "na"){
                //return 'p';
                $request['last_name']=ucfirst($request->last_name);
                
            }
        

            //return $request;

            if($request->secondary_first_name !=''){
                $request['secondary_first_name']=ucfirst(strtolower(trans($request->secondary_first_name)));
            }

        $request['mobile']='+'.$request->coun_code.$request->mobile;

        /*if($request->secondary_mobile !=''){
        $request['secondary_mobile']='+'.$request->second_count_code.$request->secondary_mobile;
        }*/

        if($request->mobilealt!=''){
             $request['mobilealt']='+'.$request->altcount_code.$request->mobilealt;
        }

        if($request->secondary_mobile!=''){
            $request['secondary_mobile']='+'.$request->second_count_code.$request->secondary_mobile;
        }

        if($request->second_mobilealt!=''){
            $request['second_mobilealt']='+'.$request->second_altcount_code.$request->second_mobilealt;
        }

        if($request->address_1 !=''){
        $request['address_1']=ucwords(strtolower($request->address_1));
        }

        if($request->address_2 !=''){
        $request['address_2']=ucwords(strtolower($request->address_2));
        }

        if($request['city_code'] !=''){
             $request['city_code']='+'.$request['countl_code'].'-'.$request['city_code'];
        }

        if($request['second_city_code'] !=''){
             $request['second_city_code']='+'.$request['second_countl_code'].'-'.$request['second_city_code'];
        }
        
        $request['user_id']=auth()->user()->id;

        $lastfetch=Vendor::select('id')->orderBy('created_at','DESC')->first();

        if(isset($lastfetch))
        {
            $request['vendor_code'] = 'SP'.str_pad($lastfetch->id + 1, 6, "0", STR_PAD_LEFT);
        }
        else{
            $request['vendor_code'] = 'SP'.str_pad(1, 6, "0", STR_PAD_LEFT);
        }
            
            /*$vendorCode1 = "SP00000";
            if($lastfetch->id==NULL)
            {
                 $vendorCode2 = 1;
                
            }
            else
            {
               $vendorCode2 = $lastfetch->id + 1;
            }
            $vendorCode2 = $lastfetch->id + 1;
            $vendorCode = $vendorCode1.$vendorCode2;
            $request['vendor_code']=$vendorCode;*/

           // return $request;
            //$cat =Category::where('name',$request->category_id)->select('id')->first();
            //$request['category_id'] = $cat->id;
            $tanents=Tanent::where('id','1')->select('id')->first();
            $request['company_id']=$tanents->id;

            $vendor=Vendor::create($request->except('_token','category_id','second_altcount_code','second_count_code'));
            //return count($request['product_group_id']);
            if(isset($request['product_category_id'])){
                for($i = 0; $i< count($request['product_category_id']); $i++)
                {
                    
                    $category['vendor_id'] = $vendor->id;
                    $category['product_group_id'] =$this->getgroup($request['prduct_group_data'],$request['product_category_id'][$i]);
                    $category['product_category_id'] = $request['product_category_id'][$i];
                    
                    VendorCategory::create($category);
                }
            }
            //}

            return redirect()->route('vendor.index');
        }
        catch (\Exception $e)
        {
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }
    }

    public function getgroup($productgroupdata, $categoryid){
        //return json_decode($productgroupdata)[0]->id;
        //return $productcategoryid[0];
        //return $productgroupdata.length();
        //for($i=0;$i<count($productcategoryid);$i++){
          for($j=0;$j<count(json_decode($productgroupdata));$j++){
            if($categoryid==json_decode($productgroupdata)[$j]->id){
                return json_decode($productgroupdata)[$j]->parent_id;
            }
          }  
        //}
    }

    public function vendorsearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = Vendor::where('first_name','like', '%'.$query.'%')->select('id','first_name as name')->get();
        }
        return response()->json($searchcategory);
    }

    public function categorysearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = Category::whereNull('parent_id')->where('name','like', '%'.$query.'%')->select('id','name')->get();
        }
        return response()->json($searchcategory);
    }



    public function childcat(Request $request){
        //return $request;
         //$cat =Category::where('name',$request->name)->select('id','name')->first();
        $category =Category::whereIN('parent_id',$request->id)->select('id','name','parent_id')->get();
        return $category;
        // return \Response::json(['status'=>'success', 'message'=>'category selected successfully.', 'data'=> $category]);
    }

    public function subcat(Request $request){
        //return $request;
        $subcategory =Category::whereIN('parent_id',$request->id)->select('id','name','parent_id')->get();
        return $subcategory;
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
        //return $id;

         $vendor=Vendor::with('category','subcategory','vendorcategory')->find($id);
        $selected_tags = array();
        $parentcat = array();
        $subcat = array();
        foreach ($vendor->vendorcategory as $post_tag) {
            array_push($selected_tags, $post_tag->product_group_id);
            array_push($parentcat, $post_tag->product_category_id);
            array_push($subcat, $post_tag->sub_category_id);
        }
        
        /*foreach ($vendor->vendorcategory as $post_tag) {
             
        }*/

        
        
        //return $selected_tags;
        //return $subcat;
        $states=State::get();
        $cities=City::get();
        $countries=Country::get();
        $categories=Category::whereNull('parent_id')->select('id','name')->where('depth','0')->get();
        $procategories=Category::where('parent_id','!=','')->where('depth','1')->get();
        $subcategories=Category::where('parent_id','!=','')->where('depth','2')->get();


        
         return view('partner.edit',compact('vendor','states','cities','countries','categories','procategories','subcategories','selected_tags','parentcat','subcat'));
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
        //
        try{
        //return $request;
        $request['first_name']=ucfirst(strtolower(trans($request->first_name)));
            if($request->middle_name!=''){
            $request['middle_name']=ucfirst(strtolower(trans($request->middle_name)));
            }
            if($request->last_name!=''){
            $request['last_name']=ucfirst(strtolower(trans($request->last_name)));
            }
            if($request->last_name=="NA" || "Na"){
                //return 'gnghg';
                $request['last_name']='';
            }

        if($request->secondary_first_name !=''){
        $request['secondary_first_name']=ucfirst(strtolower(trans($request->secondary_first_name)));
        }

        $request['mobile']='+'.$request->coun_code.$request->mobile;

        
        if($request->mobilealt!=''){
             $request['mobilealt']='+'.$request->altcount_code.$request->mobilealt;
        }

        if($request->secondary_mobile!=''){
            $request['secondary_mobile']='+'.$request->second_coun_code.$request->secondary_mobile;
        }

        if($request->second_mobilealt!=''){
            $request['second_mobilealt']='+'.$request->second_altcount_code.$request->second_mobilealt;
        }

        if($request->address_1 !=''){
        $request['address_1']=ucwords(strtolower($request->address_1));
        }

        if($request->address_2 !=''){
        $request['address_2']=ucwords(strtolower($request->address_2));
        }
        //return $request['city_code'];
        if($request->city_code !=''){
              $request['city_code']='+'.$request['countl_code'].'-'.$request->city_code;
        }

        if($request['second_city_code'] !=''){
             $request['second_city_code']='+'.$request['second_countl_code'].'-'.$request['second_city_code'];
        }
    
            $vendor=Vendor::where('id',$id)->update($request->except('_token','_method','coun_code','second_coun_code','countl_code','product_group','altcount_code','second_altcount_code','second_countl_code','secondcity_code','second_count_code','product_group_id','product_category_id','sub_category_id'));

            if(isset($request['product_group_id'])){

                VendorCategory::where('vendor_id',$id)->delete();
                
                for($i = 0; $i< count($request['sub_category_id']); $i++)
                {
                    $category['vendor_id'] = $id;
                    $category['product_group_id'] = $request['product_group_id'][$i];
                    $category['product_category_id'] = $request['product_category_id'][$i];
                    $category['sub_category_id'] = $request['sub_category_id'][$i];
                    //return $category;
                    VendorCategory::create($category);
                }
            
            }
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function vendordelete($id){
        //return $id;
         $vendor = Vendor::where('id',$id)->forceDelete();

        return \Response::json(['status'=>'success', 'message'=>'vendor deleted successfully.']);

    }
    public function destroy($id)
    {
        //
    }
}
