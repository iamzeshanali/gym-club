<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_code', 'activity_description', 'status'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }
}
