<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use App\Models\Timelog;
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
        if($request->search){
            dd($request->search);
        }
        $members = Member::where('club_id','1')->get();

        return view('dashboard/pages/timelog/timelogs', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
