<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use App\User;

class UserSubdomain extends Model
{
    protected $table = 'user_subdomains';

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
