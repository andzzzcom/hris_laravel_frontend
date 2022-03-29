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

//department
Route::group(["prefix"=>"department"], function(){
	Route::get('/', 'Departments\DepartmentController@index');
	Route::get('/edit/{id}', 'Departments\DepartmentController@edit');
	Route::post('/edit', 'Departments\DepartmentController@edit_act');
	Route::get('/add', 'Departments\DepartmentController@add');
	Route::post('/add', 'Departments\DepartmentController@add_act');
	Route::get('/delete/{id}', 'Departments\DepartmentController@delete');
	Route::post('/delete', 'Departments\DepartmentController@delete_act');
});
