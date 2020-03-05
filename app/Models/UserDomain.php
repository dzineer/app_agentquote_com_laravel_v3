<?php

namespace App\Models;

use App\User;

class UserDomain extends Model
{
    protected $table = 'user_domains';

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
