<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name',
        'description'
    ];
}
