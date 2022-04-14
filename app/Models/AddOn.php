<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    use HasFactory;
    protected $fillable = [
        'add_on_code', 'add_on_description', 'status'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }
}
