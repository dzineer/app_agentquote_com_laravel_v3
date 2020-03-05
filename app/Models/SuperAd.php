<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAd extends Model
{
    protected $table = 'super_ads';

    protected $fillable = [
        'id',
        'message',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'message' => 'string',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}