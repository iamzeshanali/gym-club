<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use App\Models\Timelog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        $timelogs = Timelog::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();


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
//        dd("done");
        $members = Member::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        $timelogs = Timelog::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();

        $data = explode("|",$request->search);
        $club = trim($data[0]);
        $email = trim($data[1]);

        $member = Member::where('email',$email)->get();

        date_default_timezone_set("Asia/Karachi");
        $date = date("H:i:s");

        $timelog = new Timelog();
//            dd(\Illuminate\Support\Facades\Session::get('club_id'));
        $timelog->club_id = \Illuminate\Support\Facades\Session::get('club_id')[0];
        $timelog->member_id = $member[0]->id;
        $timelog->time_in = $date;
        $timelog->time_out = 0;
        $timelog->timespent = 0;
        $timelog->source = '';
//            dd($timelog);
        $timelog->save();

        $members = Member::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        $timelogs = Timelog::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();


        return view('dashboard/pages/timelog/timelogs', compact('members','timelogs'));
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
        $members = Member::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        $timelogs = Timelog::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();

        date_default_timezone_set("Asia/Karachi");
        $date = date("H:i:s");

        $timelog->time_out = $date;

        $timein = strtotime($timelog->time_in);
        $timeout = strtotime($timelog->time_out);

        $timespent = $timeout - $timein;
        $timelog->timespent = date("H:i", $timespent);
        $timelog->save();
//        dd(date("H:i", $timespent));
        return view('dashboard/pages/timelog/timelogs', compact('members','timelogs'));
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
        $timelog->delete();
        return redirect()->back();
    }
}
