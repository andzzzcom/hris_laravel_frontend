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

//employee
Route::group(["prefix"=>"employee"], function(){
	Route::get('/', 'Employees\EmployeeController@index');
	Route::get('/edit/{id}', 'Employees\EmployeeController@edit');
	Route::post('/edit', 'Employees\EmployeeController@edit_act');
	Route::get('/add', 'Employees\EmployeeController@add');
	Route::post('/add', 'Employees\EmployeeController@add_act');
	Route::get('/delete/{id}', 'Employees\EmployeeController@delete');
	Route::post('/delete', 'Employees\EmployeeController@delete_act');
});
