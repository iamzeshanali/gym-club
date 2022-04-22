<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use App\Models\Timelog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = Member::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        $timelogs = Timelog::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();


        if($request->search){
//            dd("done");
            $data = explode("|",$request->search);
            $club = trim($data[0]);
            $email = trim($data[1]);

            $clubs = Club::where('user_id',Auth::user()->id)->get();
            $member = Member::where('email',$email)->get();

            date_default_timezone_set("Asia/Karachi");
            $date = date("H:i:s");

            $timelog = new Timelog();
            $timelog->club_id = $clubs[0]->id;
            $timelog->member_id = $member[0]->id;
            $timelog->time_in = $date;
            $timelog->time_out = 0;
            $timelog->source = '';
            $timelog->save();
        }

        return view('dashboard/pages/timelog/timelogs', compact('members','timelogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd("done");
        return view('dashboard/pages/timelog/add-edit-timelog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timelog  $timelog
     * @return \Illuminate\Http\Response
     */
    public function show(Timelog $timelog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timelog  $timelog
     * @return \Illuminate\Http\Response
     */
    public function edit(Timelog $timelog)
    {
        $club = Club::find($id);
        return view('dashboard/pages/clubs/add-edit-club', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timelog  $timelog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timelog $timelog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timelog  $timelog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timelog $timelog)
    {
        $club = Club::find($id);
        $club->delete();
        return redirect()->route('dashboard.clubs.index');
    }
}
