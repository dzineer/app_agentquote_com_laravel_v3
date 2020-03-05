<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use App\User;

class UserGoogleAnalytic extends Model
{
    protected $table = 'user_google_analytics';

    protected $fillable = [
        'id',
        'user_id',
        'data'
    ];

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
