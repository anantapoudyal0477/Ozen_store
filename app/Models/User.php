<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Appointment;
use App\Models\cart;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\Wishlist;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public function userAppointments()
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }

    public function userDoctors()
    {
        return $this->hasMany(Doctor::class, 'user_id', 'id');
    }
    public function userOrders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    public function userWishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }
}
