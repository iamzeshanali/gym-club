<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'price', 'status'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }
    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }
    public function activity(){
        return $this->belongsTo(Activity::class);
    }
}
