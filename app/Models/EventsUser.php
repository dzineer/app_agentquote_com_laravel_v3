<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EventsUser extends Model
{
    protected $table = 'events_user';

    protected $with = [
        'user'
    ];

    protected $fillable = [
        'affiliate_id',
        'user_id',
        'event_id'
    ];

    public function quote() {
        return $this->belongsTo(User::class);
    }
}
