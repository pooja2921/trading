<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Tanent;
use Auth;
use App\Models\State;
use App\Models\City;
use increment;
use App\Models\Country;
use Validator;

class ClientController extends Controller
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
             $clients=Client::where('first_name','like', '%'.$request->search.'%')->paginate(10);
        }
        else{
            $clients=Client::orderBy('created_at','DESC')->where('id', '!=', 0)->paginate(10);
            
        }
        return view('clients.index',compact('clients'));
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
        $countries  =Country::get();
        return view('clients.create',compact('states','cities','countries'));
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
        try{
            if($request->clientType=='Registered' || $request->clientType=='Registered-Composite'){
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
            return redirect('client/create')
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

            $request['address']=ucwords($request->address);

            if($request->address_1!=''){
                $request['address_1']=ucwords($request->address_1);
            }
            if($request->address_2!=''){
                $request['address_2']=ucwords($request->address_2);
            }
            if($request->altaddress!=''){
                $request['altaddress']=ucwords($request->altaddress);
            }

            $request['user_id']=auth()->user()->id;
            
            $lastfetch=Client::select('id')->orderBy('created_at','DESC')->first();

            if(isset($lastfetch))
            {
                $request['client_code'] = 'CL'.str_pad($lastfetch->id + 1, 6, "0", STR_PAD_LEFT);
            }
            else{
                $request['client_code'] = 'CL'.str_pad(1, 6, "0", STR_PAD_LEFT);
            }
            
            /*$clientCode1 = "CL00000";
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
            $request['client_code']=$clientCode;*/
            
            $request['status']=1;

            if($request['city_code'] !=''){
             $request['city_code']='+'.$request['countl_code'].'-'.$request['city_code'];
            }
            $client=Client::create($request->except('_token'));
            return redirect()->route('client.index');
        }
        catch (\Exception $e)
        {
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }
    }
    /*public function store(Request $request)
    {
        //return $request;
        try{
            $validator = Validator::make($request->all(), [
                'first_name'=>'required',
                'email' => 'required|unique:clients',
                'mobile' => 'required|unique:clients',
                'gst_number' => 'required|unique:clients',
            ]);

            if ($validator->fails()) {
            return redirect('client/create')
                        ->withErrors($validator)
                        ->withInput();
            }

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
            
            $lastfetch=Client::select('id')->orderBy('created_at','DESC')->first();
            
            $clientCode1 = "CL00000";
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
            $request['client_code']=$clientCode;
            
            $request['status']=1;

            if($request['city_code'] !=''){
             $request['city_code']='+'.$request['countl_code'].'-'.$request['city_code'];
            }
            $client=Client::create($request->except('_token'));
            return redirect()->route('client.index');
        }
        catch (\Exception $e)
        {
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }
    }*/
    
    public function getCity(Request $request)
    {
        //return $request;
         $city = City::where('state_id',$request->state_id)->select('id','name')->get();
        return response()->json(['city'=>$city]);
    }

    public function clientsearch(Request $request){
       // return $request;
        if($request->get('query')!=''){
            $query = $request->get('query');
            //$query=ucfirst($request->query);
        $client=Client::where('first_name','like', '%'.$query.'%')->select('first_name as name','id')->get(); 
        }
       return response()->json($client);
    }

    public function companysearch(Request $request){
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = Client::where('company_name','like', '%'.$query.'%')->select('id','company_name as name')->get();
        }
        return response()->json($searchcategory);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function clientstatus(Request $request,$id)
    {
        try{
            //return $id;
            //return $request;
            $client = Client::where('id',$id)->update(['status'=>$request['stat']]);
           return \Response::json(["status" => "success", "message" => "Client updated successfully!"]);
        }catch (Exception $e) {
            return \Response::json(["status" => "danger", "message" => $e->getMessage()]);
        }
    }


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
        $client=Client::find($id);
        $states= State::get();
        $cities = City::get();
        $countries  =Country::get();
        return view('clients.edit',compact('states','cities','client','countries'));

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
        try{
            

            
        
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

        if($request->city_code !=''){
             $request['city_code']='+'.$request['countl_code'].'-'.$request->city_code;
        }

         $client=Client::where('id',$id)->update($request->except('_token','_method','coun_code','altcount_code','countl_code'));
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
            $request['city_code']='+'.$request['countl_code'].$request['city_code'];
        }

        $client=Client::where('id',$id)->update($request->except('_token','_method','coun_code','altcount_code','countl_code'));
        return redirect()->back();

    }*/

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

    public function clientdelete($id){
        //return $id;
         $client = Client::where('id',$id)->forceDelete();

        return \Response::json(['status'=>'success', 'message'=>'client deleted successfully.']);

    }
}
