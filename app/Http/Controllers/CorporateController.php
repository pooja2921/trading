<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corporate;
use App\Models\Tanent;
use Auth;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Validator;

class CorporateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporates=Corporate::where('id', '!=', 0)->orderBy('created_at','DESC')->paginate(10);
         return view('corporate.index',compact('corporates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states= State::get();
        $cities=City::get();
        $countries=Country::get();
        return view('corporate.create',compact('states','cities','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    try{
        //return $request;
            if($request->clientType=='Registered' || $request->clientType=='Registered-Composite'){
            $validator = Validator::make($request->all(), [
                'first_name'=>'required',
                'email' => 'required|unique:corporates',
                'mobile' => 'required|unique:corporates',
                'gst_number' => 'required|unique:corporates',
            ]);
            }
            else{
                
                $validator = Validator::make($request->all(), [
                        'first_name'=>'required',
                        'email' => 'required|unique:corporates',
                        'mobile' => 'required|unique:corporates',
                    ]);
            }

            if ($validator->fails()) {
            return redirect('corporate/create')
                        ->withErrors($validator)
                        ->withInput();
            }

            $request['first_name']=ucfirst(strtolower(trans($request->first_name)));
            if($request->middle_name!=''){
            $request['middle_name']=ucfirst(strtolower(trans($request->middle_name)));
            }
            if($request->last_name=='NA'){
             //return 'gnghg';
                $request['last_name']='';
               
            }
            else if($request->last_name!="NA" || "Na" || "na"){
                //return 'p';
                $request['last_name']=ucfirst(strtolower(trans($request->last_name)));
                
            }
            /*if($request->last_name!=''){
            $request['last_name']=ucfirst(strtolower(trans($request->last_name)));
            }
            if($request->last_name=="NA" || "Na"){
                //return 'gnghg';
                $request['last_name']='';
            }*/
            //return $request;
             $request['mobile']='+'.$request->coun_code.$request->mobile;

            if($request->mobilealt!=''){
             $request['mobilealt']='+'.$request->altcount_code.$request->mobilealt;
            }

            $tanents=Tanent::where('id','1')->select('id')->first();
            $request['company_id']=$tanents->id;

            $request['address']=ucwords(strtolower($request->address));

            if($request->address_1!=''){
                $request['address_1']=ucwords(strtolower($request->address_1));
            }
            if($request->address_2!=''){
                $request['address_2']=ucwords(strtolower($request->address_2));
            }
            if($request->altaddress!=''){
                $request['altaddress']=ucwords(strtolower($request->altaddress));
            }

            $request['user_id']=auth()->user()->id;
            
            $lastfetch=Corporate::select('id')->orderBy('created_at','DESC')->first();
            
            $clientCode1 = "CO00000";
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
            $request['corporate_code']=$clientCode;
            
            $request['status']=1;

            if($request['city_code'] !=''){
             $request['city_code']='+'.$request['countl_code'].'-'.$request['city_code'];
            }
            $corporate=Corporate::create($request->except('_token'));
            return redirect()->route('corporate.index');
        }
        catch (\Exception $e)
        {
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }
    }
    /*public function store(Request $request)
    {
        //return $request;
        $request['first_name']=ucfirst(strtolower(trans($request->first_name)));
        $request['middle_name']=ucfirst(strtolower(trans($request->middle_name)));
        $request['last_name']=ucfirst(strtolower(trans($request->last_name)));
        $request['mobile']='+'.$request->coun_code.$request->mobile;
        $tanents=Tanent::where('id','1')->select('id')->first();
        $request['company_id']=$tanents->id;

        $request['address_1']=ucwords(strtolower($request->address_1));
        $request['address_2']=ucwords(strtolower($request->address_2));
        //$request['user_id']=auth()->user()->id;
        $corporate=Corporate::create($request->except('_token'));
        return redirect()->route('corporate.index');
    }*/

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
        $corporate=Corporate::find($id);
        $states= State::get();
        $cities = City::get();
        $countries=Country::get();
        return view('corporate.edit',compact('states','cities','corporate','countries'));
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
       // return $request;
        try{
            /*if($request->clientType=='Registered' || $request->clientType=='Registered-Composite'){
                //return 'if';
                $validator = Validator::make($request->all(), [
                        'first_name'=>'required',
                        'email' => 'required|unique:clients',
                        'mobile' => 'required|unique:clients',
                        'gst_number' => 'required|unique:clients',
                    ]);
            }
            else{
                
                $validator = Validator::make($request->all(), [
                        'first_name'=>'required',
                        'email' => 'required|unique:clients',
                        'mobile' => 'required|unique:clients',
                    ]);
            }

            if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }*/
        
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


        if($request->coun_code !=''){
        $request['mobile']='+'.$request->coun_code.$request->mobile;
        }

        if($request->mobilealt!=''){
         $request['mobilealt']='+'.$request->altcount_code.$request->mobilealt;
        }

        $request['address']=ucwords(strtolower($request->address));

        if($request->address_1!=''){
        $request['address_1']=ucwords(strtolower($request->address_1));
        }
        if($request->address_2!=''){
        $request['address_2']=ucwords(strtolower($request->address_2));
        }
        if($request->altaddress!=''){
            $request['altaddress']=ucwords(strtolower($request->altaddress));
        }

        if($request['city_code'] !=''){
            $request['city_code']='+'.$request['countl_code'].'-'.$request['city_code'];
        }

        $client=Corporate::where('id',$id)->update($request->except('_token','_method','coun_code','altcount_code','countl_code'));
        return redirect()->back();
        }
        catch (\Exception $e)
        {
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }

    }
    /*public function update(Request $request, $id)
    {
        //return $request;
        if($request->coun_code !=''){
        $request['mobile']='+'.$request->coun_code.$request->mobile;
        }
        $request['first_name']=ucfirst(strtolower(trans($request->first_name)));
        $request['middle_name']=ucfirst(strtolower(trans($request->middle_name)));
        $request['last_name']=ucfirst(strtolower(trans($request->last_name)));

        $request['address_1']=ucwords(strtolower($request->address_1));
        $request['address_2']=ucwords(strtolower($request->address_2));
        $client=Corporate::where('id',$id)->update($request->except('_token','_method','coun_code'));
        return redirect()->back();
    }
*/
    public function corpstatus(Request $request,$id)
    {
        try{
            //return $id;
            //return $request;
            $corporate = Corporate::where('id',$id)->update(['status'=>$request['stat']]);
           return \Response::json(["status" => "success", "message" => "Corporate updated successfully!"]);
        }catch (Exception $e) {
            return \Response::json(["status" => "danger", "message" => $e->getMessage()]);
        }
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

    public function corpdelete($id){
        //return $id;
        
         $corporate = Corporate::where('id',$id)->forceDelete();
         
        return \Response::json(['status'=>'success', 'message'=>'corporate deleted successfully.']);

    }
}
