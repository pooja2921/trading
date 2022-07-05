<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{

    public function __construct(Attribute $attributes)
    {
        $this->attributes=$attributes;
        //parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->name!=''){
            $attribute= $this->attributes->where('name','like', '%'.$request->name.'%')->select('id','name')->orderBy('created_at','DESC')->paginate(10); 
        }
        else{
            $attribute= $this->attributes->select('id','name')->orderBy('created_at','DESC')->paginate(10);
        }
         return view('items.attribute',compact('attribute'));
    }

    public function attrsearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = $this->attributes->where('name','like', '%'.$query.'%')->select('id','name')->get();
        }
        return response()->json($searchcategory);
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
             $attr=$this->attributes->where('name',$request->name)->first();
            if($attr==''){
             $item=$this->attributes->create($request->except(['_token']));
             \Session::flash('success', 'Sucessfully inserted attribute');
            }
            else{
              \Session::flash('success', 'Already inserted attribute');  
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
        //return $id;
         $attribute=$this->attributes->select('id','name')->find($id);
         //return view('items.edit-attribute',compact('attribute'));
          return \Response::json(['status'=>"success", 'message'=>'attributes edit successfully.', 'attr'=>$attribute]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateattr(Request $request)
    {
        //return $request;
        $attr= $this->attributes->where('id',$request->id)->update(['name'=>$request->name]);
        return \Response::json(['status'=>'success', 'message'=>'attributes updated successfully.']);
    }

    /*public function update(Request $request, $id)
    {
        $attr= $this->attributes->where('id',$id)->update($request->except(['_token','_method']));
        return redirect()->route('attribute.create');
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function attributedelete($id){
        $attributes = $this->attributes->where('id',$id)->forceDelete();

        return \Response::json(['status'=>'success', 'message'=>'attributes deleted successfully.']);
    }
    public function destroy($id)
    {
        //
    }
}
