<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function () {
    return redirect('admin/dashboard');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    Route::match(['get','post'],'login','AdminController@login');
    Route::match(['get','post'],'registeruserinfo','AdminController@registeruserinfo');


    Route::group(['middleware'=>['admin']], function(){

        Route::match(['get','post'],'dashboard','AdminController@dashboard');
        Route::match(['get','post'],'logout','AdminController@logout');

        Route::match(['get','post'],'usercontrol','AdminController@usercontrol');
        Route::match(['get','post'],'adduserinfo','AdminController@adduserinfo');
        Route::match(['get','post'],'deleteuserinfo','AdminController@deleteuserinfo');
        Route::match(['get','post'],'edituserinfo','AdminController@edituserinfo');
        Route::match(['get','post'],'updateuserinfo','AdminController@updateuserinfo');
        Route::match(['get','post'],'edituserStatusinfo','AdminController@edituserStatusinfo');

        });

});
