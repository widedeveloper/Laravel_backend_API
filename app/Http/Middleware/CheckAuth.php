<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $parameters = $request->all();
        $authorization = explode(' ',$request->header('Authorization'));
     
        $authorization = explode(':',base64_decode($authorization[1]));
       
        $username = $authorization[0];
        $password = $authorization[1];

        if (Auth::attempt(['email' => $username, 'password' => $password] )) {
            return $next($request);
        } else {
            return response()->json(array('err'=>'Not Authorization'));
        }
       
    }
}
