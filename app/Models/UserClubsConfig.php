<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClubsConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_clubs', 'max_users'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
