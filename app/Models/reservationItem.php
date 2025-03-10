<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservationItem extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'adults_count',
        'children_count',
        'room_price',
        'number_of_nights',
        'subtotal',
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function reservation_item_services()

    {
        return $this->hasManyThrough(Service::class, Reservation_Item_Service::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
