<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::paginate(3);
        return view('users.role',compact('roles'));
    }
    
    public function create()
    {
        return view('users.roleAdd');
    }

    public function store(Request $request)
    {
        $role= new Role();
        $role->title= $request['title'];
        $role->description= $request['desc'];
        $role->save();
        return redirect('roles');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('users.roleEdit',compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->description   = Input::get('desc');
        $role->title          = Input::get('title');
       
        $role->save();
        return redirect('roles');
    }

    public function destroy($id)
    {
        $user = Role::find($id);
        $user->delete();
        return redirect('roles');
    }
}
