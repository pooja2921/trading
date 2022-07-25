<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return 'dvgdfgdf';
        if($request->search!=''){
            $states= State::where('name','like', '%'.$request->search.'%')->select('id','name')->orderBy('created_at','DESC')->paginate(10); 
        }
        else{
         $states=State::orderBy('created_at','DESC')->select('id','name')->paginate(10);
        }
        return view('state.index',compact('states'));
    }

    public function statesearch(Request $request){

       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = State::where('name','like', '%'.$query.'%')->select('id','name')->get();
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
        $state=State::create($request->except('_token','Save'));
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
        //return $id;
        $state=State::find($id);
         return \Response::json(['status'=>"success", 'message'=>'state edit successfully.', 'state'=>$state]);
    }

    public function stateupdate(Request $request){
        //return $request;
         $state=State::where('id',$request->id)->update($request->except('_token','Save'));
         return redirect()->back();
    }

    public function statedelete($id){

        $state=State::where('id',$id)->forceDelete();
         
        return \Response::json(['status'=>'success', 'message'=>'state deleted successfully.']);
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
}
