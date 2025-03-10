<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Eloquent\Model;

class Employee extends Authenticatable
{
    //
    use HasApiTokens, HasRoles, HasFactory;


    protected $guard_name = 'employee';
    protected $fillable = [
        'name',
        'email',
        'password',
        'contactinfo',
        'role',
        'salary',
    ];

    // public function setPasswordAttribute($value)
    // {
    //     if (!empty($value)) {
    //         $this->attributes['password'] = Hash::make($value);
    //     }
    // }
}
