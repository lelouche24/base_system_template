<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CosController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\SubmenuController;

// use Auth;
// use Validator;
// use Session;
// use Hash;
// use DB;
// use DataTables;
// use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['as' => 'AUTH.'], function(){
    Route::get('/',[LoginController::class, 'SHOWLOGIN'])->name('SHOWLOGIN');
    Route::post('/',[LoginController::class,'LOGIN'])->name('LOGIN');
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
});

Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware' => ['CheckUserStatus','UserRouteExist','LastActivity']], function () {
    
        Route::resource('menu',MenuController::class);
        Route::resource('submenu',SubmenuController::class);
        Route::resource('user',UserController::class);
        
        Route::match(['get','post','patch','put','delete'],'user/update/access',[UserController::class,'update_access'])->name('user.update_access');
        Route::match(['get','post','patch','put','delete'],'user/change/password',[UserController::class,'change_password'])->name('user.change_password');
        Route::match(['get','post','patch','put','delete'],'user/activate/{slug}/{status}',[UserController::class,'activate'])->name('user.activate');
        
        Route::resource('main',MainController::class);

        // Route::match(['get','post'], 'dashboard',[AdminController::class,'dashboard']);
        

 });


// Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

//     Route::match(['get','post'],'login','AdminController@login');
//     Route::match(['get','post'],'registeruserinfo','AdminController@registeruserinfo');


  
//     Route::group(['middleware'=>['admin']], function(){

//         Route::match(['get','post'],'logout','AdminController@logout');

//         Route::match(['get','post'],'usercontrol','AdminController@usercontrol');
//         Route::match(['get','post'],'adduserinfo','AdminController@adduserinfo');
//         Route::match(['get','post'],'deleteuserinfo','AdminController@deleteuserinfo');
//         Route::match(['get','post'],'edituserinfo','AdminController@edituserinfo');
//         Route::match(['get','post'],'updateuserinfo','AdminController@updateuserinfo');
//         Route::match(['get','post'],'edituserStatusinfo','AdminController@edituserStatusinfo');
        
//         });

// });
