<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{


    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard_name = 'web';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'total_points',
        'loyalty_level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // public function Loyalty_Program()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function whishlist()
    {
        return $this->belongsTo(wishlist::class);
    } //

    function Reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    function reviews()
    {
        return $this->hasMany(review::class);
    }
}
