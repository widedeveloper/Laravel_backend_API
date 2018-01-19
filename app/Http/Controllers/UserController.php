<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    public function index()
    {
        $users = DB::table('users')
            ->join('roles', 'users.role', '=', 'roles.id')
            ->select('users.*', 'roles.title', 'users.id')
            ->paginate(3);
        // $users = User::paginate(3);
        return view('users.index',compact('users'));
    }
    
    public function create()
    {
        $roles = Role::all();
        return view('users.userAdd',compact('roles'));
    }

    public function store(Request $request)
    {
        $user= new User();
        $user->name= $request['name'];
        $user->email= $request['email'];
        $user->role= $request['role'];
        $user->password= bcrypt("123456");
        $user->save();
        return redirect('users');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('users.userEdit',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name   = Input::get('name');
        $user->email          = Input::get('email');
        $user->role          = Input::get('role');
       
        $user->save();
        return redirect('users');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('users');
    }
}
