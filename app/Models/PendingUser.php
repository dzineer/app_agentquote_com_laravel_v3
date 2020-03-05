<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'type_id',
        'confirmation_id',
        'created_at',
        'expires_at',
        'updated_at'
    ];
}
