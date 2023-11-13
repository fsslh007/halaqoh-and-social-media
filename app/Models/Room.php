<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Enable lazy loading for the user relationship
    protected $with = ['user'];

    protected $fillable = [
        'name',
        'user_id',
        'meeting_time',
        'password',
        'description',
        'leaving_url',
        // Add other fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function uploadFiles()
    {
        return $this->hasMany(UploadFile::class);
    }
}
