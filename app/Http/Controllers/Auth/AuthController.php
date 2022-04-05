<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $role = Role::where('name', 'owner')->get();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $role[0]["id"];
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard.index');
        }else{
            return  redirect('login')->withSuccess('Email or Password Incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
