<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LoginsLog extends Model
{
    protected $table = 'logins_log';

    protected $fillable = [
        'affiliate_id',
        'user_id',
        'event_id'
    ];

    protected $with = [
      'event', 'user'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(EventType::class, 'event_id');
    }
}
