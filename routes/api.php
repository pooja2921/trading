<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\CategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/token', [ApiController::class,'gettoken']);
Route::post('/login', [ApiController::class,'login']);
//Route::get('login', [AuthController::class,'login']);
Route::get('parentcategory', [CategoryController::class,'parentcategory']);

Route::get('getsubcategory', [CategoryController::class,'getsubcategory']);

Route::get('getsubchildcat', [CategoryController::class,'getsubchildcat']);

Route::get('item', [CategoryController::class,'item']);

Route::get('itemdetail', [CategoryController::class,'itemdetail']);

Route::group(['middleware' => 'auth:api'], function(){
	
	Route::post('logout', [AuthController::class,'logout']);

	

	
});
