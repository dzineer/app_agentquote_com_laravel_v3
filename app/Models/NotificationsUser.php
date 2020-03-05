<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationsUser extends Model
{
    protected $table = 'notifications_user';

    protected $fillable = [
        'user_id',
        'notifications_enabled'
    ];

    /**
     * Carbon date setup
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }
}
