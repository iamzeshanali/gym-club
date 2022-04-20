<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserClubsConfig;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        if(count($role) > 0){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $role[0]["id"];
            $user->password = Hash::make($request->password);

            $user->save();

            if($user){
                $config  = new UserClubsConfig();
                $config->user_id = $user->id;
                $config->max_clubs = 2;
                $config->max_users = 2;

                $config->save();
            }
            return redirect()->route('login');
        }else{
            return back()->withErrors([
                'roles-error' => 'The provided credentials do not match our records.',
            ]);
        }

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
            return back()->withErrors([
                'login-failed' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout()
    {
        Session::remove('club_id');
        Auth::logout();
        return redirect()->route('login');
    }
}
