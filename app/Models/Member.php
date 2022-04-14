<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_code', 'name', 'mobile', 'email', 'image', 'dob', 'gender', 'member_type', 'member_role', 'enrollment_type', 'enrollment_date', 'start_date', 'status'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function membership(){
        return $this->belongsTo(Membership::class);
    }
}
