<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    protected $table = "categorys";
    protected $fillable = [

        'category_name',
        'description',
    ];


    public function rooms()
    {
        return $this->hasMany(Room::class, 'category_id', 'id');
    }
}
