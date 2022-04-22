<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        dd(Auth::user()->club);
        if(Auth::user()->role->name == 'admin'){
            $subscriptions = Subscription::all();
        }else{
            if(\Illuminate\Support\Facades\Session::exists('club_id')){
                $subscriptions = Subscription::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
            }else{
                $subscriptions = [];
            }
        }

        return view('dashboard/pages/subscriptions/subscriptions', compact('subscriptions'));
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
            $$clubs = Club::where('id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        }

        $last = Subscription::latest()->first();
        if(isset($last)){
            $code = 'sub-'.$last->id+1;
        }else{
            $code = 'sub-1';
        }
        return view('dashboard/pages/subscriptions/add-edit-subscription', compact('clubs','code'));
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
            'subscription_code' => 'required',
            'subscription_description' => 'required',
            'months' => 'required',
        ]);
        $subscription = new Subscription();

        $subscription->club_id = $request->club;


        if ($request->status){
            $subscription->status = $request->status;
        }else{
            $subscription->status = 'inactive';
        }

        $subscription->subscription_code = $request->subscription_code;
        $subscription->subscription_description = $request->subscription_description;
        $subscription->months = $request->months;
        $subscription->save();
//        dd($subscription);
        return redirect()->route('dashboard.subscriptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        }
        return view('dashboard/pages/subscriptions/add-edit-subscription', compact('subscription', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'club' => 'required',
            'subscription_code' => 'required',
            'subscription_description' => 'required',
            'months' => 'required',
        ]);


        $subscription->club_id = $request->club;

        if ($request->status){
            $subscription->status = $request->status;
        }else{
            $subscription->status = 'inactive';
        }

        $subscription->subscription_code = $request->subscription_code;
        $subscription->subscription_description = $request->subscription_description;
        $subscription->months = $request->months;

        $subscription->save();
//        dd($subscription);
        return redirect()->route('dashboard.subscriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('dashboard.subscriptions.index');
    }
}
