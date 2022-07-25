<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\Tanent;
use Auth;
use App\Models\State;
use App\Models\City;
use increment;
use App\Models\Country;
use App\Models\Client;
use App\Models\User;
use App\Models\Corporate;
use App\Models\Measurement;
use App\Models\Category;
use App\Models\EnquiryItem;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Vendor;
use DB;
use App\Models\RfqToVendor;
use App\Models\VendorRfq;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $request;
        if($request->search!=''){
             $enquiries=Enquiry::where('enquiry_no','like', '%'.$request->search.'%')->paginate(10);
        }
        else{
            $enquiries=Enquiry::orderBy('created_at','DESC')->paginate(10);
            
        }
        return view('enquiries.index',compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states= State::get();
        $cities =City::get();
        $countries=Country::get();
        $users=User::get();
        $user_id=auth()->user()->id;
        $user=User::where('id',$user_id)->select('id','user_code')->first();
        $measurements= Measurement::get();
        $categories=Category::whereNull('parent_id')->get();
        $clients=Client::select('id','first_name','last_name','company_name','city_id')->with('citydetail')->get();
        $corporates=Corporate::with('citydetail')->get();
        $products=Product::where('id','!=','0')->get();
        return view('enquiries.create',compact('states','cities','countries','users','corporates','measurements','categories','clients','user_id','products','user'));
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
        
        $request['created_by_id']=auth()->user()->id;
        
        $lastfetch=Enquiry::select('id')->orderBy('created_at','DESC')->first();
        
        if(isset($lastfetch))
        {
            $request['enquiry_no'] = 'ENQ'.str_pad($lastfetch->id + 1, 6, "0", STR_PAD_LEFT);
        }
        else{
            $request['enquiry_no'] = 'ENQ'.str_pad(1, 6, "0", STR_PAD_LEFT);
        }

            /*$clientCode1 = "ENQ00000";
            if($lastfetch->id==NULL)
            {
                 $clientCode2 = 1;
                
            }
            else
            {
               $clientCode2 = $lastfetch->id + 1;
            }
            $clientCode2 = $lastfetch->id + 1;
            $clientCode = $clientCode1.$clientCode2;
            $request['enquiry_no']=$clientCode;
*/
            $request['UnqRngCode']=mt_rand(100000, 999999);
        
               // return $request;

        $enquiry=Enquiry::create($request->except('_token','client'));

        if(isset($request['quantity'])){
            for($i = 0; $i< count($request['quantity']); $i++)
            {
                $enq['enquiry_id'] = $enquiry->id;
                $enq['customer_product_description'] = $request['customer_product_description'][$i];
                $enq['customer_UOM'] = $request['customer_UOM'][$i];
                $enq['quantity'] = $request['quantity'][$i];
                $enq['product_name'] = isset($request['product_name'][$i]) ? $request['product_name'][$i]:'';
                $enq['product_id'] = $request['product_id'][$i];
                $enq['product_group_id'] = isset($request['product_group_id'][$i]) ? $request['product_group_id'][$i]:'';
                $enq['product_category_id'] = isset($request['product_category_id'][$i]) ? $request['product_category_id'][$i]:'';
                $enq['product_subcategory_id'] = isset($request['product_subcategory_id'][$i]) ? $request['product_subcategory_id'][$i]:'' ;
                $enq['product_specification'] = $request['product_specification'][$i];
                $enq['UOM'] = $request['UOM'][$i];
                $enq['image'] = $request['image'][$i];
                
                //return $enq;
                EnquiryItem::create($enq);
            }
            
        }

        return redirect()->route('enquiry.index');
    }

    public function getCity(Request $request)
    {
        //return $request;
         $city = City::where('state_id',$request->state_id)->select('id','name')->get();
        return response()->json(['city'=>$city]);
    }

    public function searchclient(Request $request){
        //return $request;

        $client=Client::where('id',$request->id)->with('citydetail','statedetail','countrydetail')->first();

        $states= State::get();
        $cities =City::get();
        $countries=Country::get();

       return response()->json(['status'=>'success', 'message'=>'enquiry search successfully.','client'=>$client,'states'=>$states,'cities'=>$cities,'countries'=>$countries]);
       /*if($request->get('query')!=''){
            $query = $request->get('query');
            
        $client=Client::where('first_name','like', '%'.$query.'%')->select('id','first_name as name','last_name','company_name')->get(); 
        }*/
    }

    public function corporatesearch(Request $request){
        //return $request;
        $corp=Corporate::where('id',$request->id)->with('citydetail','statedetail','countrydetail')->first();
        $states= State::get();
        $cities =City::get();
        $countries=Country::get();
        /*if($request->get('query')!=''){
            $query = $request->get('query');
            
        $client=Corporate::where('first_name','like', '%'.$query.'%')->select('id','first_name as name','last_name','company_name')->get(); 
        }*/
       return response()->json(['status'=>'success', 'message'=>'enquiry search successfully.','corp'=>$corp,'states'=>$states,'cities'=>$cities,'countries'=>$countries]);
    }

    public function searchproduct(Request $request){
        $pro=Product::where('id',$request->id)->with('productcategory')->first();
        $measurements= Measurement::get();
        $categories=Category::whereNull('parent_id')->where('depth','0')->select('id','name')->get();
        $procategories=Category::where('parent_id','!=','')->where('depth','1')->get();
        $subcategories=Category::where('parent_id','!=','')->where('depth','2')->get();

        $selected_tags = array();
        $parentcat = array();
        $subcat = array();
        foreach ($pro->productcategory as $post_tag) {
            array_push($selected_tags, $post_tag->product_group_id);
            array_push($parentcat, $post_tag->product_category_id);
            array_push($subcat, $post_tag->sub_category_id);
        }

         //$progroup=  implode(',', $parentcat);
        $parentcategory=Category::whereIN('id',$parentcat)->select('id','name')->get();
        $childcategory=Category::whereIN('id',$subcat)->select('id','name')->get();

        return response()->json(['status'=>'success', 'message'=>'enquiry search successfully.','pro'=>$pro,'measurements'=>$measurements,'categories'=>$categories,'selected_tags'=>$selected_tags,'parentcat'=>$parentcat,'subcat'=>$subcat,'procategories'=>$procategories,'subcategories'=>$subcategories,'parentcategory'=>$parentcategory,'childcategory'=>$childcategory]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function enquirystatus(Request $request,$id)
    {
        try{
            //return $id;
            //return $request;
            $client = Enquiry::where('id',$id)->update(['status'=>$request['stat']]);
           return \Response::json(["status" => "success", "message" => "Client updated successfully!"]);
        }catch (Exception $e) {
            return \Response::json(["status" => "danger", "message" => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //return $id;
        $user_id=auth()->user()->id;
        $user=User::where('id',$user_id)->select('id','user_code')->first();
        $measurements= Measurement::get();

        $states= State::get();
        $cities =City::get();
        $countries=Country::get();
        $vendors=Vendor::where('id','!=','0')->get();

          $enquiry=Enquiry::where('id',$id)->with('citydetail','enquirydetail')->first();

        $selected_tags = array();
        $parentcat = array();
        $subcat = array();

        foreach ($enquiry->enquirydetail as $pro) {
           // return $pro;
            foreach($pro->products as $product){
                //return $product;
            foreach($product->productcategory as $post_tag){
                //return $post_tag;
                array_push($selected_tags, $post_tag->product_group_id);
                array_push($parentcat, $post_tag->product_category_id);
                array_push($subcat, $post_tag->sub_category_id);
            }
            }
        }

        //return $selected_tags;

         //$progroup=  implode(',', $parentcat);
        

        $progroup=Category::whereIN('id',$selected_tags)->select('id','name','parent_id')->get();
        $parentcategory=Category::whereIN('id',$parentcat)->select('id','name','parent_id')->get();
         $childcategory=Category::whereIN('id',$subcat)->select('id','name','parent_id')->get();

        $categories=Category::whereNull('parent_id')->select('id','name')->where('depth','0')->get();
        $procategories=Category::where('parent_id','!=','')->where('depth','1')->get();
        $subcategories=Category::where('parent_id','!=','')->where('depth','2')->get();

        return view('enquiries.rfq',compact('user_id','measurements','enquiry','states','cities','vendors','progroup','parentcategory','childcategory','categories','user','procategories','subcategories','selected_tags','parentcat','subcat'));
    }

    public function childcategory(Request $request){
        //return $request;
         
        $category =Category::whereIN('parent_id',$request->id)->select('id','name')->get();
        return $category;
        
    }

    public function subcategory(Request $request){
        //return $request;
        $subcategory =Category::whereIN('parent_id',$request->id)->select('id','name','parent_id')->get();
        return $subcategory;
    }

    public function searchvendor(Request $request){
        //return $request;
        $vendor= DB::table('vendors')->join('vendor_categories','vendor_categories.vendor_id','=','vendors.id')->where('vendors.state_id',$request->state)->orwhere('vendors.city_id',$request->city)->orwhereIN('vendor_categories.product_group_id',$request->progroup)->orwhereIN('vendor_categories.product_category_id',$request->procat)->orwhereIN('vendor_categories.sub_category_id',$request->subcat)->select('vendors.id','vendors.first_name','vendors.vendor_code')->get();
        return $vendor;
        
    }

    public function vendorcode(Request $request){
        //return $request;
        $vendor=Vendor::whereIN('id',$request->vendor)->select('id','first_name','vendor_code')->get();
        return $vendor;
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
        $enquiry=Enquiry::with('enquirydetail')->find($id);
        $states= State::get();
        $cities =City::get();
        $countries=Country::get();
        $users=User::get();
        $corporates=Corporate::get();
        $measurements= Measurement::get();
        $categories=Category::whereNull('parent_id')->get();
        $products=Product::where('id','!=','0')->with('productcategory')->get();

        $selected_tags = array();
        $parentcat = array();
        $subcat = array();

        foreach ($enquiry->enquirydetail as $pro) {
            foreach($pro->products as $product){
                foreach($product->productcategory as $post_tag){
                    array_push($selected_tags, $post_tag->product_group_id);
                    array_push($parentcat, $post_tag->product_category_id);
                    array_push($subcat, $post_tag->sub_category_id);
                }
            }
        }

        //return $parentcat;

         //$progroup=  implode(',', $parentcat);
        $progroup=Category::whereIN('id',$selected_tags)->select('id','name')->get();
         $parentcategory=Category::whereIN('id',$parentcat)->select('id','name')->get();
        $childcategory=Category::whereIN('id',$subcat)->select('id','name')->get();
        
        $clients=Client::select('id','first_name','last_name','company_name','city_id')->with('citydetail')->get();
        return view('enquiries.edit',compact('states','cities','countries','users','corporates','measurements','categories','enquiry','products','progroup','parentcategory','childcategory','clients'));

    }

    public function storerfq(Request $request){
        //return $request;
        
        
            /*$clientCode1 = "RFQ00000";

             //return substr($lastfetch->rfq_number, -5);
            if($lastfetch->id==NULL)
            {
                 $clientCode2 = 1;
                
            }
            else
            {
                //$code= substr($lastfetch->rfq_number, -5);
                $code= preg_replace('/[^0-9]/', '', $lastfetch->rfq_number);  

                $clientCode2 = $code + 1;
            }
            $clientCode2 = $code + 1;
             $clientCode = 'RFQ'.'00000'.$clientCode2;
             $request['rfq_number']=$clientCode;*/

            if(isset($request['vendor_id'])){
            for($i = 0; $i< count($request['vendor_id']); $i++)
            {
                $lastfetch=RfqToVendor::select('id','rfq_number')->orderBy('created_at','DESC')->first();
        
                if(isset($lastfetch))
                {
                    $request['rfq_number'] = 'RFQ'.str_pad($lastfetch->id + 1, 6, "0", STR_PAD_LEFT);
                }
                else{
                    $request['rfq_number'] = 'RFQ'.str_pad(1, 6, "0", STR_PAD_LEFT);
                }
                $enq['enquiry_id'] = $request->enquiry_id;
                $enq['product_id'] =isset($request['product_id'][$i]) ? $request['product_id'][$i]:'';
                $enq['enquiry_item_id'] = isset($request['enquiry_item_id'][$i]) ? $request['enquiry_item_id'][$i]:'';
                $enq['vendor_id'] = isset($request['vendor_id'][$i]) ? $request['vendor_id'][$i]:'';
                $enq['rfq_number']=$request['rfq_number'];
                $enq['created_by_id']=auth()->user()->id;
            //return $enq;
                $rfq=RfqToVendor::create($enq);

                $rfqven=VendorRfq::whereIN('vendor_id',$request['vendor_id'])->where('enquiry_id',$request->enquiry_id)->select('id','enquiry_id','vendor_id')->get();

                if($rfqven=='[]'){
                    //return 'if';
                   if(isset($request['vendor_id'])){
                        for($i = 0; $i< count($request['vendor_id']); $i++)
                        {
                            $venrfq=VendorRfq::select('id')->orderBy('created_at','DESC')->first();

                            if(isset($venrfq))
                            {
                                $request['rfq_number'] = 'ES'.str_pad($venrfq->id + 1, 6, "0", STR_PAD_LEFT);
                            }
                            else{
                                $request['rfq_number'] = 'ES'.str_pad(1, 6, "0", STR_PAD_LEFT);
                            }
                            //return $request['rfq_number'];
                            $erfq['enquiry_supplier_no']=$request['rfq_number'];
                            $erfq['rfq_id'] = $rfq->id;
                            $erfq['enquiry_id'] = $request->enquiry_id;
                            $erfq['vendor_id'] =isset($request['vendor_id'][$i]) ? $request['vendor_id'][$i]:'';
                            //return $erfq;
                            VendorRfq::create($erfq);
                        }
                    } 
                }
                
            }
            
        }
        //return $rfq;
        //return 

        
        
       
       return redirect()->back();

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
        $request['created_by_id']=auth()->user()->id;
        
        $enquiry=Enquiry::where('id',$id)->update($request->except('_token','_method','coun_code','client','countl_code','corpotate_address_line1','secondary_pincode','customer_product_description','customer_UOM','quantity','product_id','product_name','product_group_id','product_category_id','product_subcategory_id','product_subcategory_id','product_specification','UOM','image','product',
            'product_group','product_group_name','sub_category_id','product_category_name','product_subcategory_name'));

        if(isset($request['quantity'])){
            for($i = 0; $i< count($request['quantity']); $i++)
            {
                EnquiryItem::where('enquiry_id',$id)->delete();
                $enq['enquiry_id'] = $id;
                $enq['customer_product_description'] = $request['customer_product_description'][$i];

                $enq['customer_UOM'] = $request['customer_UOM'][$i];
                $enq['quantity'] = $request['quantity'][$i];

                $enq['product_name'] = isset($request['product_name'][$i]) ? $request['product_name'][$i]:'';

                $enq['product_id'] = $request['product_id'][$i];

                $enq['product_group_id'] = isset($request['product_group_id'][$i]) ? $request['product_group_id'][$i]:'';

                $enq['product_category_id'] = isset($request['product_category_id'][$i]) ? $request['product_category_id'][$i]:'';

                $enq['product_subcategory_id'] = isset($request['product_subcategory_id'][$i]) ? $request['product_subcategory_id'][$i]:'' ;

                $enq['product_specification'] = $request['product_specification'][$i];

                $enq['UOM'] = $request['UOM'][$i];

                $enq['image'] = $request['image'][$i];
                
                //return $enq;
                EnquiryItem::create($enq);
            }
            
        }

        /*if(isset($request['quantity'])){
            for($i = 0; $i< count($request['quantity']); $i++)
            {
                $enq['enquiry_id'] = $id;
                $enq['customer_product_description'] = $request['customer_product_description'][$i];
                $enq['customer_UOM'] = $request['customer_UOM'][$i];
                $enq['quantity'] = $request['quantity'][$i];
                $enq['product_name'] = $request['product_name'][$i];
                $enq['product_id'] = $request['product_id'][$i];
                $enq['product_group_id'] = $request['product_group_id'][$i];
                $enq['product_category_id'] = $request['product_category_id'][$i];
                $enq['product_subcategory_id'] = $request['sub_category_id'][$i];
                $enq['product_specification'] = $request['description'][$i];
                $enq['customer_UOM'] = $request['customer_UOM'][$i];
                $enq['image'] = $request['image'][$i];
                
                
                //return $enq;
                EnquiryItem::create($enq);
            }
        }*/
        return redirect()->back();
    //}
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

    public function enquirydelete($id){
        //return $id;
         $client = Enquiry::where('id',$id)->forceDelete();

        return \Response::json(['status'=>'success', 'message'=>'enquiry deleted successfully.']);

    }
}
