<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_code', 'subscription_description', 'months', 'status'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }
}
