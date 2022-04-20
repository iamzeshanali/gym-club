<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class AuthUserClubsServices
{
    public function currentUserClubs(){

        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
        }
        return $clubs;
    }
}
