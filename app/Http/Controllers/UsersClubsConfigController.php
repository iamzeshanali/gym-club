<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserClubsConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UsersClubsConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = UserClubsConfig::all();

        return view('dashboard/pages/users-clubs-config/users-config', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard/pages/users-clubs-config/add-edit-config', compact('users'));
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
            'user' => 'required',
            'max_clubs' => 'required',
            'max_users' => 'required',
        ]);

        $prev_user = UserClubsConfig::where('user_id','=',$request->user)->get();
        if(count($prev_user) > 0){
            return back()->withErrors([
                'user-error' => 'User Already Exists.',
            ]);
        }else{
            $config  = new UserClubsConfig();
            $config->user_id = $request->user;
            $config->max_clubs = $request->max_clubs;
            $config->max_users = $request->max_users;

            $config->save();

            return redirect()->route('dashboard.user-clubs-config.index');
        }

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
        $config = UserClubsConfig::find($id);
//        dd($user);
        $users = User::all();
        return view('dashboard/pages/users-clubs-config/add-edit-config', compact('config', 'users'));
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

        $config  =  UserClubsConfig::find($id);
        $config->user_id = $request->user;
        $config->max_clubs = $request->max_clubs;
        $config->max_users = $request->max_users;

        $config->save();

        return redirect()->route('dashboard.user-clubs-config.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $config  =  UserClubsConfig::find($id);
        $config->delete();
        return redirect()->route('dashboard.user-clubs-config.index');
    }
}
