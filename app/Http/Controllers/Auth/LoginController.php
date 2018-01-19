<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        return view ("auth.login");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where (['email' => $request->email])->get();
        $user_count = $user->count();

        if($validator->passes()) {
            if($user_count <= 0)
            {
                return redirect()->back()->withInput($request->all())->with("status"," Email or password is wrong.");
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
            {

                $is_active = Auth::user()->is_active;
                if($is_active==0){
                    return redirect()->back()->withInput($request->only("email", "password"))->with('status','Wait the allow for this site.');
                }

                // $isAdmin = Auth::user()->role;
                // if($isAdmin == 2 && $request->is('admin/*')) {
                //     return redirect(url("admin/home"));
                // }
                return redirect()->intended("/");
            }else{
                return redirect()->back()->withInput($request->only("email", "password"))->with('status','Email or Password is wrong');
            }

           
        }else{
            return redirect()->back()->withInput($request->only("email", "password"))->withErrors($validator);
        }
       
    }

     public function authenticate($email,$password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended($this->redirectPath());
        }
    }

    public function logout() {

        Auth::logout();
        return redirect()->intended("/");
        // return view("auth.login");
    }
}
