<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'meet_name',
        'meet_date',
        'meet_time',
        'meet_location',
    ];
}
