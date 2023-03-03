<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users=User::paginate(5);
        return view('admin.users.index',compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'role_as'=>['required','integer'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as'=>$request->role_as,
        ]);
        return redirect('/admin/users')->with('message','User Create Successfully');
    }
    public function edit(int $userId)
    {
        $user=User::findOrFail($userId);
        return view('admin.users.edit',compact('user'));
    }
    public function update(Request $request,$userId)
    {
        $validated=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
            'role_as'=>['required','integer'],
        ]);
        User::findOrFail($userId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as'=>$request->role_as,
        ]);
        return redirect('/admin/users')->with('message','User Created Successfully');
    }
}