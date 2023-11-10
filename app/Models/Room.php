<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'meeting_time',
        'password',
        'description',
        'leaving_url',
        // Add other fields as needed
    ];
}
