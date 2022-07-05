<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Item;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {

            $item= Product::count();
            $usercount= User::count();
            $newitem = Product::select('id','name','brand','image')->orderBy('created_at','DESC')->take(5)->get();
            $users=User::select('id','name','mobile','created_at')->orderBy('created_at','DESC')->take(4)->get();

            return view('pages.dashboard',compact('users','usercount','newitem','item')); 
        }
        catch (Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    

    
}
