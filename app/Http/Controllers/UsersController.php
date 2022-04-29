<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Role;
use App\Models\User;
use App\Models\UserClub;
use Dms\Common\Structure\FileSystem\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Illuminate\Support\Facades\Session::exists('club_id')){
            $user_clubs= UserClub::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
            if(count($user_clubs) > 0){
                $users = [];
                foreach ($user_clubs as $club){
                    $tempClub= User::where('id',$club->user_id)->get();
                    if(count($tempClub) > 0){
                        array_push($users,$tempClub[0]);
                    }

                }
            }else{
                $users = [];
            }
        }else{
            $users = [];
        }
       return view('dashboard/pages/users/users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard/pages/users/add-edit-user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $role = Role::where('name', $request->role)->get();
        $user->role_id = $role[0]["id"];

        $user->password = Hash::make($request->password);
        $user->comments = $request->comments;

        $user_image = $request->file('user_image');
//        dd($user_image);
        if($user_image){
            $user_image->move(public_path('images'), $user_image->getClientOriginalName());
            $user->user_image = $user_image->getClientOriginalName();
        }else{
            $user->user_image = null;
        }
//        dd($user);

        $user->save();

        $userClub = new UserClub();
        $userClub->user_id = $user->id;
        $userClub->club_id = \Illuminate\Support\Facades\Session::get('club_id')[0];

        $userClub->save();

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
//        dd($user);
        $roles = Role::all();
        return view('dashboard/pages/users/add-edit-user', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $role = Role::where('name', $request->role)->get();
        $user->role_id = $role[0]["id"];

        $user->password = Hash::make($request->password);
        $user->comments = $request->comments;

        $user_image = $request->user_image;
        if(isset($user->user_image)){
            if(isset($user_image)){
                if($user->user_image != $request->user_image){
                    $path = public_path('/images/'.$user->user_image);
                    if(File::exists($path)){
                        File::delete($path);
                        $user_image->move(public_path('images'), $user_image->getClientOriginalName());
                        $user->user_image = $user_image->getClientOriginalName();
                    }
                }
            }
        }else{
            $user_image->move(public_path('images'), $user_image->getClientOriginalName());
            $user->user_image = $user_image->getClientOriginalName();
        }


        $user->save();
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(isset($user->user_image)){
            $path = public_path('/images/'.$user->user_image);
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $user->delete();
        return redirect()->route('dashboard.users.index');
    }
}
