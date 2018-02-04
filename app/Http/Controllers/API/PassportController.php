<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Radio;
use App\Region;
use App\Stream;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
    //
    public $successStatus = 200;

    public function login() {
        if(Auth::attempt(['email'=>request('email'), 'password'=> request('password')])){
            $user = Auth::user();
            $success['token'] = $user->createToken('app')->accessToken;
            $success['userId'] = $user->id;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
           
            return response()->json($success, $this->successStatus);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function getradiosData() {
        if(request('vdate')!=''){
            $radios = Radio::whereBetween('created_at', [request('vdate'), request('vdate')." 23:59:59"])->limit(100)->get();
        }else{
            $radios = Radio::limit(100)->get();
        }
        
        return response()->json($radios, $this->successStatus);
    }

    public function getregionsData() {
        if(request('vdate')!=''){
            $regions = Region::whereBetween('created_at', [request('vdate'), request('vdate')." 23:59:59"])->limit(100)->get();
        } else {
            $regions = Region::limit(100)->get();
        }
        
        return response()->json($regions, $this->successStatus);
    }

    public function getstreamsData() {
        if(request('vdate')!=''){
            $streams = Stream::whereBetween('created_at', [request('vdate'), request('vdate')." 23:59:59"])->limit(100)->get();
        } else {
            $streams = Stream::limit(100)->get();
        }
        
        return response()->json($streams, $this->successStatus);
    }
}
