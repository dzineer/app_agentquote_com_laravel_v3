<?php

namespace App\Models;

class WhmcsUserUser extends Model
{
    protected $table = 'whmcs_user_users';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whmcs_users() {
        return $this->belongsTo(WhmcsUser::class, 'whmcs_user_id');
    }

}
