<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use DB;

class CategoryController extends Controller
{
    /*public function __construct(Category $category)
    {  
        
        $this->category = $category;
    }*/

    public function parentcategory(Request $request){
    	//return $request;
        if($request->name!=''){
               
               $category= DB::table('categories')
                ->where('categories.name','like', '%'.$request->name.'%')
                ->join('items', 'items.category_id', '=', 'categories.id')
                ->select('categories.id as id', 'categories.name as name', DB::raw("count(items.id) as itemcount"))
                ->groupBy('categories.id')
                ->get();
        }
        else{
                
                $category= DB::table('categories')
                ->join('items', 'items.category_id', '=', 'categories.id')
                ->select('categories.id as id', 'categories.name as name', DB::raw("count(items.id) as itemcount"))
                ->groupBy('categories.id')
                ->get();
               
        }
        

      return \Response::json(["status"=>"success", "message"=>"Category show successfully!","category"=> $category]);
    }

    public function getsubcategory(Request $request){
        //return $request->id;
        if($request->name!=''){
                
                $category= DB::table('categories')
                ->where('categories.name','like', '%'.$request->name.'%')
                ->join('items', 'items.subcategory_id', '=', 'categories.id')
                ->select('categories.id as id', 'categories.name as name', DB::raw("count(items.id) as itemcount"))
                ->groupBy('categories.id')
                ->get();
        }
        else{
            
             $category= DB::table('categories')
                ->where('categories.parent_id',$request->parent_id)
                ->join('items', 'items.subcategory_id', '=', 'categories.id')
                ->select('categories.id as id', 'categories.name as name', DB::raw("count(items.id) as itemcount"))
                ->groupBy('categories.id')
                ->get();
        }
        
        return \Response::json(["status"=>"success", "message"=>"Sub Category show successfully!","subcategory"=> $category]);
    }

    public function getsubchildcat(Request $request){
        //return $id;
        if($request->name!=''){

           $category= DB::table('categories')
                ->where('categories.name','like', '%'.$request->name.'%')
                ->join('items', 'items.childcategory_id', '=', 'categories.id')
                ->select('categories.id as id', 'categories.name as name', DB::raw("count(items.id) as itemcount"))
                ->groupBy('categories.id')
                ->get();
        }
        else{
            
            $category= DB::table('categories')
                ->where('categories.parent_id',$request->parent_id)
                ->join('items', 'items.childcategory_id', '=', 'categories.id')
                ->select('categories.id as id', 'categories.name as name', DB::raw("count(items.id) as itemcount"))
                ->groupBy('categories.id')
                ->get();
        }
        return \Response::json(["status"=>"success", "message"=>"Child Category show successfully!","childcategory"=> $category]);
    }

    public function item(Request $request)
    {
    	//return $request;
        $item= Item::where('childcategory_id',$request->id)->select('id','name','available')->get();

        return \Response::json(["status"=>"success", "message"=>"Items show successfully!","item"=> $item]);
    	
    }

    public function itemdetail(Request $request)
    {
        //return $request;
        $item= Item::where('id',$request->id)->select('id','name','available','description')->with('imagedetail')->get();

        return \Response::json(["status"=>"success", "message"=>"Items show successfully!","item"=> $item]);
        
    }
}
