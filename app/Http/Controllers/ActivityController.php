<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Club;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->name == 'admin'){
            $activities = Activity::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
            $activities = Activity::where('club_id',$clubs[0]->id)->get();
        }

        return view('dashboard/pages/activities/activities', compact('activities'));
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
        return view('dashboard/pages/activities/add-edit-activity', compact('clubs'));
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
            'activity_code' => 'required',
            'activity_description' => 'required',
        ]);

        $activity = new Activity();

        $activity->club_id = $request->club;


        if ($request->status){
            $activity->status = $request->status;
        }else{
            $activity->status = 'inactive';
        }

        $activity->activity_code = $request->activity_code;
        $activity->activity_description = $request->activity_description;
        $activity->save();

        return redirect()->route('dashboard.activities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
        }
        return view('dashboard/pages/activities/add-edit-activity', compact('clubs','activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'club' => 'required',
            'activity_code' => 'required',
            'activity_description' => 'required',
        ]);

        $activity->club_id = $request->club;


        if ($request->status){
            $activity->status = $request->status;
        }else{
            $activity->status = 'inactive';
        }

        $activity->activity_code = $request->activity_code;
        $activity->activity_description = $request->activity_description;
        $activity->save();

        return redirect()->route('dashboard.activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('dashboard.activities.index');
    }
}
