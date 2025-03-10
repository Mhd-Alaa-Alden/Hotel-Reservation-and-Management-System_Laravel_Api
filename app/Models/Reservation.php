<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = [
        'user_id',
        // 'reservation_items',
        'guest_name',
        'guest_phone',
        'guest_email',
        'total_amount',
        'notes',
        'Reservistion_status',
        'services_requested',
        'payment_method',
        'payment_status',
        'payment_reference',
    ];

    function Reservation_Items()
    {
        return $this->hasMany(reservationItem::class);
    }
    // function Reservation_Item()
    // {
    //     return $this->belongsTo(Reservation_Item::class);
    // }


    function user()
    {
        return $this->belongsTo(User::class);
    }
}
