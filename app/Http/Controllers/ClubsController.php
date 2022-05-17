<?php

namespace App\Http\Controllers;

use App\Mail\ClubRegisterMail;
use App\Mail\NewRegisterMail;
use App\Models\Club;
use App\Models\UserClub;
use App\Models\UserClubsConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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
            $user_clubs= UserClub::where('user_id',Auth::user()->id)->get();
            if(count($user_clubs) > 0){
                $clubs = [];
                foreach ($user_clubs as $club){
                    $tempClub= Club::where('id',$club->club_id)->get();
                    array_push($clubs,$tempClub[0]);
                }
            }else{
                $clubs = [];
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
        $response = Http::get('https://countriesnow.space/api/v0.1/countries/currency');
        $countries = $response->collect($key = null)["data"];
//        dd($countries);
//        $res2 = Http::post('https://countriesnow.space/api/v0.1/countries/cities', [
//            'country' => 'pakistan'
//        ]);

//        dd($res2->collect($key = null)["data"]);

        return view('dashboard/pages/clubs/add-edit-club', compact('countries'));
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
        $currentClubs = UserClub::where('user_id',Auth::user()->id)->count();

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

                $userClub = new UserClub();
                $userClub->user_id = Auth::user()->id;
                $userClub->club_id = $club->id;

                $userClub->save();

                Mail::to("test@test.com")->send(new ClubRegisterMail($club->club_name));
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
