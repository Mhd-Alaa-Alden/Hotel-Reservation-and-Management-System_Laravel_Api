<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'category_id',
        'room_number',
        'capacity',
        'floor',
        'bathroom',
        'price',
        'images',
        'description',
        'AvailabilityStatus',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function review()
    {
        return  $this->hasMany(Review::class);
    }

    public function reservation_Items()
    {
        return $this->hasMany(reservationItem::class);
    }
}
