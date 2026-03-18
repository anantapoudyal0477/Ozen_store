<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSession extends Model
{
    use HasFactory;

    protected $table = "custom_sessions";

    protected $fillable = [
        'token',
        'guard',
        'user_id',
        'ip',
        'user_agent',
        'expires_at',  // corrected
        'created_at',
        'updated_at',
    ];

    public $timestamps = true; // optional, if you want auto created_at/updated_at
}
