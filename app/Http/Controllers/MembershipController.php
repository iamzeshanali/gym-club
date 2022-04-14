<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->name == 'admin'){
            $memberships = Membership::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
            $memberships = Membership::where('club_id',$clubs[0]->id)->get();
        }

        return view('dashboard/pages/membership/membership', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
        }

//        dd($clubs[0]->subscription[0]->subscription_code);

        return view('dashboard/pages/membership/add-edit-membership', compact('clubs'));
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
            'club' => 'required',
            'subscription' => 'required',
            'activity' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $membership = new Membership();
        $membership->club_id = $request->club;
        $membership->subscription_id = $request->subscription;
        $membership->activity_id = $request->activity;
        $membership->description = $request->description;
        $membership->price = $request->price;
        $membership->status = 'active';
        $membership->save();

        return redirect()->route('dashboard.memberships.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
        }

//        dd($clubs[0]->subscription[0]->subscription_code);

        return view('dashboard/pages/membership/add-edit-membership', compact('clubs','membership'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'club' => 'required',
            'subscription' => 'required',
            'activity' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $membership->club_id = $request->club;
        $membership->subscription_id = $request->subscription;
        $membership->activity_id = $request->activity;
        $membership->description = $request->description;
        $membership->price = $request->price;
        $membership->status = 'active';
        $membership->save();

        return redirect()->route('dashboard.memberships.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('dashboard.memberships.index');
    }
}
