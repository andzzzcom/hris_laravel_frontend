<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::group(["middleware"=>"isAdmin"], function(){
Route::group([], function(){
	Route::group(["prefix"=>"admin"], function(){
		Route::get('/home', 'HomeController@index');
		Route::get('/logout', 'Auth\Login@logout');
					
		//employee service
		include("routes/admin/employee.php");

		//department service
		include("routes/admin/department.php");

		//designation service
		include("routes/admin/designation.php");
		
		//admin service
		include("routes/admin/admin.php");
		
		//settings service
		include("routes/admin/settings.php");
	});
});


Route::get("/", "Auth\Login@redirect_login");
Route::group(["prefix"=>"admin"], function(){
	Route::get("/", "Auth\Login@redirect_login");
	Route::get("/login", "Auth\Login@login");
	Route::post("/login", "Auth\Login@login_act");
	Route::get('/forgot', 'Auth\Forgot@forgot');
	Route::post('/forgot', 'Auth\Forgot@forgot_act');
	Route::get('/reset_pass/{email}/{token}', 'Auth\Forgot@reset_pass');
	Route::post('/reset_pass', 'Auth\Forgot@reset_pass_act');
	
	Route::get("/create_table/tes", "Admin\Table\Table@index");
});