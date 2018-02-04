<?php

use Illuminate\Http\Request;

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

Route::post('api_login','API\PassportController@login');

Route::group(['middleware'=>'auth:api'], function(){
    Route::post('api_get_data/radios','API\PassportController@getradiosData');
    Route::post('api_get_data/regions','API\PassportController@getregionsData');
    Route::post('api_get_data/streams','API\PassportController@getstreamsData');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
