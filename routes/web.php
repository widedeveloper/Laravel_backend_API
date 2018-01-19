<?php

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


Auth::routes();

Route::get('/','HomeController@index');
Route::get("/logout","Auth\LoginController@logout");

Route::get('/home','HomeController@index');
//**************start************//
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('countries', 'CountryController');
Route::resource('regions', 'RegionController');

Route::get('roles/delete/{id}','RoleController@destroy');
Route::get('users/delete/{id}','UserController@destroy');
Route::get('countries/delete/{id}','CountryController@destroy');
Route::get('regions/delete/{id}','RegionController@destroy');
//**************end****************//

Route::post('radios/setstatus','RadioController@setactive');
Route::get('radios/delete/{id}','RadioController@destroy');
Route::get('radios/edit/{id}','RadioController@edit');
Route::PATCH('radios/{id}','RadioController@update');
Route::get('radios/show/{id}','RadioController@show');

