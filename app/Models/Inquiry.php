<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_code', 'name', 'mobile', 'email', 'inquiry_text', 'source', 'reference', 'comments', 'followup', 'enroll_status', 'status'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }
}

