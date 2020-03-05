<?php

namespace App\Models;

use App\User;

/**
 * Class WhmcsUser
 *
 * @package App\Models
 */
class WhmcsUser extends Model
{
    protected $table = 'whmcs_users';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whmcs_users_users() {
        return $this->belongsTo(WhmcsUserUser::class);
    }

    public function assignUser(User $user) {
        $this->whmcs_users_users()->create([
            'whmcs_user_id' => $this->id,
            'user_id' => $user->id
        ]);
    }
}
