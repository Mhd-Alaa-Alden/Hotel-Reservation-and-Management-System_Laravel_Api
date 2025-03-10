<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'room_id',
        'rating',
        'review',
    ];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function room()
    {
        return $this->belongsTo(Room::class);
    }
}
