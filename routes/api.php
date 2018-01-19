<?php

use App\Region;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Auth\TokenGuard;
use Illuminate\Support\Facades\DB;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//    dd($request->user());
// });

Route::get('/regions',function(Request $request) {
   
    $parameters=  $request->get('cc');
  
    if(!$parameters) {
      return response()->json(array('err'=>'please fill all parameters'));
    } else {
      
        $data =  DB::table('regions as r')
                  ->select('r.id', 'r.name')
                  ->join('countries as c','c.id','=','r.country_id')
                  ->where('c.code',$parameters)
                  ->get();
        return response()->json(array('result'=>'ok','data'=>$data));
    }
})->middleware('checkAuth');
