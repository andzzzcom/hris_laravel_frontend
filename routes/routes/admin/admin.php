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

//article
Route::group(["prefix"=>"admin"], function(){
	Route::get('/', 'Admins\AdminController@index');
	Route::get('/edit/{id}', 'Admins\AdminController@edit');
	Route::post('/edit', 'Admins\AdminController@edit_act');
	Route::get('/add', 'Admins\AdminController@add');
	Route::post('/add', 'Admins\AdminController@add_act');
	Route::get('/delete/{id}', 'Admins\AdminController@delete');
	Route::post('/delete', 'Admins\AdminController@delete_act');
});

//role
Route::group(["prefix"=>"role"], function(){
	Route::get('/', 'Users\RoleController@index');
	Route::post('/edit', 'Users\RoleController@edit_act');
	Route::post('/add', 'Users\RoleController@add_act');
	Route::post('/delete', 'Users\RoleController@delete_act');
	Route::post('/detail', 'Users\RoleController@detail');
	Route::post('/menu', 'Users\RoleController@menu');
	Route::post('/status', 'Users\RoleController@status');
});

//menu
Route::group(["prefix"=>"menu"], function(){
	Route::get('/', 'Users\MenuController@index');
	Route::post('/edit', 'Users\MenuController@edit_act');
	Route::post('/add', 'Users\MenuController@add_act');
	Route::post('/delete', 'Users\MenuController@delete_act');
	Route::post('/detail', 'Users\MenuController@detail');
});

//role menu
Route::group(["prefix"=>"role_menu"], function(){
	Route::post('/', 'Users\RoleController@role_menu');
	Route::get('/detail/{id}', 'Users\RoleController@role_menu_detail');
});
