<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'LevelName',
        'condition_type',
        'condition_value ',
        'additional_services',
        'discount_rate',
    ];

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
