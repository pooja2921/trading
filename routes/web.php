<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\DeliveryTimeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\EnquiryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 



Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('register', [RegisterController::class,'register']);
Route::get('/saveotp',  [RegisterController::class,'saveotp'])->name('otp.save');
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('password/forget',  function () { 
	return view('pages.forgot-password'); 
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');

Route::group(['middleware' => ['auth']], function() {
Route::group(['middleware' => ['verified']], function() {
Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
});
});




Route::group(['middleware' => 'auth'], function(){

	/**
    * Verification Routes
    */
    Route::get('/email/verify', [VerificationController::class,'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', [VerificationController::class,'resend'])->name('verification.resend');
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

	
/* product routes start */

   //Route::group(['middleware' => 'can:manage_item|manage_user'], function(){
    	

    Route::get('catsearch', [ItemController::class, 'catsearch'])->name('catsearch');	
    
    Route::get('brandsearch', [ItemController::class, 'brandsearch'])->name('brandsearch');
    
    Route::get('deleteimg/{id}', [ItemController::class, 'deleteimg']);
    Route::get('/items/delete/{id}', [ItemController::class,'itemdelete'])->name('itemdelete');

    Route::get('itemsearch', [ItemController::class,'itemsearch'])->name('itemsearch');

    Route::get('/items/get-list', [ItemController::class,'getitemlist']);
	/*Route::get('getsubchildcat', [ItemController::class,'getsubchildcat'])->name('getsubchildcat');*/
    Route::get('item/getsubcat', [ItemController::class,'getsubcat'])->name('getsubcat');
    Route::get('item/getchildcat', [ItemController::class,'getchildcat'])->name('getchildcat');
    Route::resource('items', '\App\Http\Controllers\ItemController');

/* product routes end */

/* category routes start */

    //Route::group(['middleware' => 'can:manage_categories|manage_user'], function(){
  

Route::post('updatecat', [CategoriesController::class,'updatecat'])->name('updatecat');
    	Route::post('storecat', [CategoriesController::class,'storecat'])->name('storecat');

  Route::get('showchild/{id}', [CategoriesController::class,'showchild'])->name('showchild');
    Route::get('editsubcat/{id}', [CategoriesController::class,'editsubcat'])->name('editsubcat');
	Route::get('subcategory', [CategoriesController::class,'subcategory'])->name('subcategory');
	Route::get('category/deleteimg/{id}', [CategoriesController::class, 'deleteimg']);
	Route::get('categorydetail/{id}', [CategoriesController::class, 'categorydetail']);
	Route::get('/autocompletesearch', [CategoriesController::class, 'autocompletesearch']);
	Route::post('updatecategory', [CategoriesController::class,'updatecategory'])->name('updatecategory');
	Route::get('category/search', [CategoriesController::class,'search'])->name('categories.search'); 
	Route::get('category/searchchild', [CategoriesController::class,'searchchild'])->name('categories.searchchild'); 

	Route::get('categorydelete/{id}', [CategoriesController::class,'categorydelete'])->name('categorydelete');
	Route::get('backend/getselectedcategory', [CategoriesController::class,'getSelectedCategory'])->name('categories.getselectedcategory');
    Route::resource('categories', '\App\Http\Controllers\CategoriesController');
	//});
/* category routes end */

/*vendor route*/
Route::get('vendorsearch', [VendorController::class,'vendorsearch'])->name('vendorsearch');

Route::get('vendordelete/{id}', [VendorController::class,'vendordelete'])->name('vendordelete');

Route::get('subcat', [VendorController::class,'subcat'])->name('subcat');

Route::get('childcat', [VendorController::class,'childcat'])->name('childcat');

Route::get('categorysearch', [VendorController::class,'categorysearch'])->name('categorysearch');
Route::resource('vendor', '\App\Http\Controllers\VendorController');

/*vendor route*/

/* client routes start */

Route::get('companysearch', [ClientController::class,'companysearch'])->name('companysearch');

Route::get('clientstatus/{id}', [ClientController::class,'clientstatus'])->name('clientstatus');
Route::get('clientsearch', [ClientController::class,'clientsearch'])->name('clientsearch');
Route::get('getCity', [ClientController::class,'getCity'])->name('getCity');
Route::get('clientdelete/{id}', [ClientController::class,'clientdelete'])->name('clientdelete');
Route::resource('client', '\App\Http\Controllers\ClientController');

/* client routes end */

/* corporate routes start */
Route::get('corpsearch', [CorporateController::class,'corpsearch'])->name('corpsearch');

Route::get('corpstatus/{id}', [CorporateController::class,'corpstatus'])->name('corpstatus');
Route::get('corpdelete/{id}', [CorporateController::class,'corpdelete'])->name('corpdelete');
Route::resource('corporate', '\App\Http\Controllers\CorporateController');
/* corporate routes start */

/* enquiry routes start */

Route::post('storerfq', [EnquiryController::class,'storerfq'])->name('storerfq');
Route::get('vendorcode', [EnquiryController::class,'vendorcode'])->name('vendorcode');

Route::get('searchvendor', [EnquiryController::class,'searchvendor'])->name('searchvendor');

Route::get('subcategory', [EnquiryController::class,'subcategory'])->name('subcategory');

Route::get('childcategory', [EnquiryController::class,'childcategory'])->name('childcategory');

Route::get('searchproduct', [EnquiryController::class,'searchproduct'])->name('searchproduct');

Route::get('corporatesearch', [EnquiryController::class,'corporatesearch'])->name('corporatesearch');

Route::get('searchclient', [EnquiryController::class,'searchclient'])->name('searchclient');

Route::resource('enquiry', '\App\Http\Controllers\EnquiryController');
/* enquiry routes end */

/* city routes start */
Route::get('citysearch', [CityController::class,'citysearch'])->name('citysearch');

Route::get('citydelete/{id}', [CityController::class,'citydelete'])->name('citydelete');
Route::post('cityupdate', [CityController::class,'cityupdate'])->name('cityupdate');
Route::resource('city', '\App\Http\Controllers\CityController');
/* city routes start */

/* state routes start */
Route::get('statesearch', [StateController::class,'statesearch'])->name('statesearch');


Route::get('statedelete/{id}', [StateController::class,'statedelete'])->name('statedelete');
Route::post('stateupdate', [StateController::class,'stateupdate'])->name('stateupdate');
Route::resource('state', '\App\Http\Controllers\StateController');
/* state routes end */

/* user routes start */
	//only those have manage_user permission will get access
	//Route::group(['middleware' => 'can:manage_user'], function(){
		Route::get('usersearch', [UserController::class,'usersearch'])->name('usersearch');
		Route::get('/users', [UserController::class,'index']);
		Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	//});

/* user routes end */


/* role routes start */
	//only those have manage_role permission will get access
	//Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		
		Route::get('rolesearch', [RolesController::class,'rolesearch'])->name('rolesearch');
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	//});
/* role routes start */

/* permission routes start */

	//only those have manage_permission permission will get access
	//Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('permissionsearch', [PermissionController::class,'permissionsearch'])->name('permissionsearch');
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	//});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


	// permission examples
    Route::get('/permission-example', function () {
    	return view('permission-example'); 
    });
 
/* permission routes start */
   
	Route::get('/profile', function () { return view('pages.profile'); });
	
	/*Route::get('/products', function () { return view('inventory.product.list'); });
	Route::get('/products/create', function () { return view('inventory.product.create'); });*/


 
/* measurement routes start */
    Route::get('measurementsearch', [MeasurementController::class,'measurementsearch'])->name('measurementsearch');
    Route::get('updatemeasure', [MeasurementController::class,'updatemeasure'])->name('updatemeasure');
    Route::get('measuredelete/{id}', [MeasurementController::class,'measuredelete'])->name('measuredelete');
    Route::resource('measurement', '\App\Http\Controllers\MeasurementController');
/* measurement routes start */

/* Delivery routes start */
    Route::get('timesearch', [DeliveryTimeController::class,'timesearch'])->name('timesearch');
    Route::get('updatetime', [DeliveryTimeController::class,'updatetime'])->name('updatetime');
    Route::get('timedelete/{id}', [DeliveryTimeController::class,'timedelete'])->name('timedelete');
    Route::resource('delivery', '\App\Http\Controllers\DeliveryTimeController');
//});
 /* Delivery routes start */ 
	
});


Route::get('/register', function () { return view('auth.register'); });
