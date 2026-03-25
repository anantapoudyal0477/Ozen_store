<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admins';
    protected $table = 'administrators';

    protected $fillable = [
        'name', 'email', 'password', 'is_active',
        'failed_login_attempts', 'locked_until',
        'last_login_at', 'last_login_ip'
    ];

    protected $hidden = ['password', 'remember_token'];

    // ---------------- RELATIONSHIPS ----------------
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'administrator_roles',
            'administrator_id',
            'role_id'
        );
    }

    public function details()
    {
        return $this->hasOne(AdministratorDetail::class, 'administrator_id');
    }

    // ---------------- ATTRIBUTE CASTS ----------------
    protected $casts = [
        'name' => 'encrypted',          // Encrypt name for privacy
        'email' => 'encrypted',         // Encrypt email for privacy
        'password' => 'hashed',          // Laravel hashes automatically
        'last_login_at' => 'datetime',
        'locked_until' => 'datetime',
        'is_active' => 'boolean',
        'failed_login_attempts' => 'integer',
    ];
}
