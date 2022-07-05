<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryTime;

class DeliveryTimeController extends Controller
{

    public function __construct(DeliveryTime $deliverytimes)
    {
        $this->deliverytimes=$deliverytimes;
        //parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->name!=''){
            $deliverytimes= $this->deliverytimes->where('expected_delivery','like', '%'.$request->name.'%')->select('id','expected_delivery')->orderBy('created_at','DESC')->paginate(10); 
        }
        else{
            $deliverytimes= $this->deliverytimes->select('id','expected_delivery')->orderBy('created_at','DESC')->paginate(10);
        }
         return view('delivery.index',compact('deliverytimes')); 
    }

    public function timesearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = $this->deliverytimes->where('expected_delivery','like', '%'.$query.'%')->select('id','expected_delivery')->get();
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
        //
        //return $request;
            $attr=$this->deliverytimes->where('expected_delivery',$request->name)->first();
            if($attr==''){
                $item=$this->deliverytimes->create($request->except(['_token']));
             \Session::flash('success', 'Sucessfully inserted deliverytimes');
            }
            else{
              \Session::flash('success', 'Already inserted deliverytimes');  
            }
            
            return redirect()->back();
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
        //
         $delivery=$this->deliverytimes->select('id','expected_delivery')->find($id);
         
          return \Response::json(['status'=>"success", 'message'=>'delivery edit successfully.', 'attr'=>$delivery]);
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

    }

    public function updatetime(Request $request)
    {
        //return $request;
        $delivery= $this->deliverytimes->where('id',$request->id)->update(['expected_delivery'=>$request->expected_delivery]);
         \Session::flash('success', 'Sucessfully updated delivery');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function timedelete($id){
        $deliverytimes = $this->deliverytimes->where('id',$id)->forceDelete();

        return \Response::json(['status'=>'success', 'message'=>'deliverytimes deleted successfully.']);
    }

    public function destroy($id)
    {
        //
    }
}
