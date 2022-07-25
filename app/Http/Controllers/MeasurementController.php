<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement;

class MeasurementController extends Controller
{
    public function __construct(Measurement $measurements)
    {
        $this->measurements=$measurements;
        //parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->search!=''){
            $measurements= $this->measurements->where('name','like', '%'.$request->search.'%')->select('id','name')->orderBy('created_at','DESC')->paginate(10); 
        }
        else{
            $measurements= $this->measurements->select('id','name')->orderBy('created_at','DESC')->paginate(10);
        }
         return view('measurement.index',compact('measurements')); 
    }

    public function measurementsearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = $this->measurements->where('name','like', '%'.$query.'%')->select('id','name')->get();
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
            $attr=$this->measurements->where('name',$request->name)->first();
            if($attr==''){
             $item=$this->measurements->create($request->except(['_token']));
             \Session::flash('success', 'Sucessfully inserted measurements');
            }
            else{
              \Session::flash('success', 'Already inserted measurements');  
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
         $measurements=$this->measurements->select('id','name')->find($id);
         //return view('items.edit-attribute',compact('attribute'));
          return \Response::json(['status'=>"success", 'message'=>'measurements edit successfully.', 'attr'=>$measurements]);
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
        $measurement=$this->measurements->select('id','name')->find($id);
         //return view('items.edit-attribute',compact('attribute'));
          return \Response::json(['status'=>"success", 'message'=>'measurements edit successfully.', 'attr'=>$measurement]);
    }

    public function updatemeasure(Request $request)
    {
        //return $request;
        $measure= $this->measurements->where('id',$request->id)->update(['name'=>$request->name]);
         \Session::flash('success', 'Sucessfully updated measurements');
        return redirect()->back();
    }

    public function measuredelete($id){
        $measurements = $this->measurements->where('id',$id)->forceDelete();

        return \Response::json(['status'=>'success', 'message'=>'measurements deleted successfully.']);
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
