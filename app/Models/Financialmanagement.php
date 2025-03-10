<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financialmanagement extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'category',
        'source',
        'amount',
        'total_amount',
        'description',
        'transaction_date',
    ];
}
