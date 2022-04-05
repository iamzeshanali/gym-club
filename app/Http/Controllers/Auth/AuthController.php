<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

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
        $user->password = $request->password;

        $user->save();

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        dd("Login");
        $role = Role::where('name', 'owner')->get();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $role[0]["id"];
        $user->password = $request->password;

        $user->save();

        return redirect()->route('login');
    }
}
