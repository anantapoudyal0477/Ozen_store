<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;
    protected $table = "abouts";
    protected $fillable = ['about_topic_title', 'about_topic_description'];
    protected $casts = [
        'about_topic_title'=>'encrypted',
        'about_topic_description'=>'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

}
