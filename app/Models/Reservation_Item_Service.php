<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation_Item_Service extends Model
{
    use HasFactory;

    protected $table = 'reservation_item_services';
    protected $fillable = [
        'services_id',
        'reservation_items_id',
        'service_price',
        'quantity',
        'subtotal_services',
    ];

    function reservationitem()
    {
        return  $this->belongsTo(reservationitem::class);
    }
    function service()
    {
        return  $this->belongsTo(Service::class);
    }
}
