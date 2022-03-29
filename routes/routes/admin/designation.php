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

//designation
Route::group(["prefix"=>"designation"], function(){
	Route::get('/', 'Designations\DesignationController@index');
	Route::get('/edit/{id}', 'Designations\DesignationController@edit');
	Route::post('/edit', 'Designations\DesignationController@edit_act');
	Route::get('/add', 'Designations\DesignationController@add');
	Route::post('/add', 'Designations\DesignationController@add_act');
	Route::get('/delete/{id}', 'Designations\DesignationController@delete');
	Route::post('/delete', 'Designations\DesignationController@delete_act');
});
