<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_out', 'time_in', 'source'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
