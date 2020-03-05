<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $fillable = [
        'user_id',
        'confirmation_type',
        'confirmation_token',
        'created_at',
        'expires_at',
        'updated_at'
    ];
}
