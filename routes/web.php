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

Route::get('/','HomeController@index')->middleware('auth');
Route::get("/logout","Auth\LoginController@logout");
Route::get("/changepass","Auth\ResetPasswordController@index");
Route::post("/passreset","Auth\ResetPasswordController@updatepass");

Route::get('/home','HomeController@index');

//**************start************//
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('countries', 'CountryController');
Route::resource('regions', 'RegionController');
Route::resource('podcasts','PodcastController');
Route::resource('episodes','EpisodeController');
Route::resource('streams','StreamController');

Route::get('roles/delete/{id}','RoleController@destroy');
Route::get('users/delete/{id}','UserController@destroy');
Route::get('countries/delete/{id}','CountryController@destroy');
Route::get('regions/delete/{id}','RegionController@destroy');
Route::get('podcasts/delete/{id}','PodcastController@destroy');
Route::get('episodes/delete/{id}','EpisodeController@destroy');
Route::get('streams/delete/{id}','StreamController@destroy');

//**************end****************//


// --            Radios actions     ---//
Route::get('radios','RadioController@index');
Route::post('radios','RadioController@store');
Route::get('radios/create','RadioController@create');
Route::post('radios/setstatus','RadioController@setactive');
Route::get('radios/seturl','RadioController@seturl');
Route::post('radios/select_country','RadioController@select_country');
Route::get('radios/delete/{id}','RadioController@destroy');
Route::get('radios/edit/{id}','RadioController@edit');
Route::PATCH('radios/{id}','RadioController@update');
Route::get('radios/show/{id}','RadioController@show');
Route::get('radios/search','RadioController@searchfield');

Route::post('streams/delete_stream','StreamController@radio_stream_delete');
Route::post('streams/setstatus','StreamController@setactive');


Route::get('reports','ReportController@index');

Route::get('cron','CronController@index');