<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'servicename',
        'description',
        'price',
        'stock_quantity',
        'Services_status',
    ];

    function Reservation_Item_Services()
    {

        return $this->hasManyThrough(reservationItem::class, reservation_Item_Service::class);
    }
}
