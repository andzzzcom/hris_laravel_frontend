<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//settings
Route::group(["prefix"=>"setting"], function(){
	Route::get('/general', 'Settings\SettingController@general');
	Route::post('/general', 'Settings\SettingController@general_act');
});
