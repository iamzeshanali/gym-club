<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\UserClubsConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClubsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $max_clubs = UserClubsConfig::where('user_id',Auth::user()->id)->get();
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
        }

        return view('dashboard/pages/clubs/clubs', compact('clubs'));
    }

    public function changeClub($id){
            Session::remove('club_id');
            Session::push('club_id',$id);

        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/pages/clubs/add-edit-club');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $max_clubs = UserClubsConfig::where('user_id',Auth::user()->id)->get();
        $currentClubs = Club::where('user_id',Auth::user()->id)->count();

//        dd($max_clubs[0]->max_clubs);
//        dd($currentClubs);
        if (isset($max_clubs)){
            if($currentClubs < $max_clubs[0]->max_clubs){
                $request->validate([
                    'club_name' => 'required|min:3|unique:clubs',
                    'contact_name' => 'required|min:3',
                    'contact_email' => 'required|email',
                    'address' => 'required',
                    'mobile' => 'required',
                    'type' => 'required',
                ]);

                $club = new Club();
                $club->user_id = Auth::user()->id;
                if ($request->status){
                    $club->status = $request->status;
                }else{
                    $club->status = 'pending';
                }

                $club->club_name = $request->club_name;
                $club->contact_name = $request->contact_name;
                $club->contact_email = $request->contact_email;
                $club->address = $request->address;
                $club->mobile = $request->mobile;
                $club->type = $request->type;
                $club->comment = $request->comment;
                $club->note = $request->note;

                $club->save();

                return redirect()->route('dashboard.clubs.index');
            }else{
                return back()->withErrors([
                    'club-limit-error' => 'The provided credentials do not match our records.',
                ]);
            }
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
        $club = Club::find($id);
        return view('dashboard/pages/clubs/add-edit-club', compact('club'));
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
        $request->validate([
            'club_name' => 'required',
            'contact_name' => 'required|min:3',
            'contact_email' => 'required|email',
            'address' => 'required',
            'mobile' => 'required',
            'type' => 'required',
        ]);

//        dd($request->all());
        $club = Club::find($id);
        $club->user_id = Auth::user()->id;
        if ($request->status){
            $club->status = $request->status;
        }else{
            $club->status = 'pending';
        }

        $club->club_name = $request->club_name;
        $club->contact_name = $request->contact_name;
        $club->contact_email = $request->contact_email;
        $club->address = $request->address;
        $club->mobile = $request->mobile;
        $club->type = $request->type;
        $club->comment = $request->comment;
        $club->note = $request->note;

        $club->save();

        return redirect()->route('dashboard.clubs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $club = Club::find($id);
        $club->delete();
        return redirect()->route('dashboard.clubs.index');
    }
}
