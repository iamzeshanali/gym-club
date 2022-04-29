<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Subscription;
use App\Models\UserClub;
use Illuminate\Support\Facades\Auth;

class AuthUserClubsServices
{
    public function currentUserClubs(){

        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{

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

        }
        return $clubs;
    }
}
