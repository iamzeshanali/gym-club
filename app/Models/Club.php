<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_name', 'type', 'address', 'contact_name', 'contact_email', 'mobile', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subscription(){
        return $this->hasMany(Subscription::class);
    }

    public function activity(){
        return $this->hasMany(Activity::class);
    }


}
