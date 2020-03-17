<?php

namespace App\Models;

use App\User;

/**
 * Class QuoterUser
 *
 * @package App\Models
 */
class QuoterUser extends Model
{
    protected $table = 'quoter_users';

    protected $fillable = [
        'user_id',
        'active'
    ];


    /**
     * @param \App\User $user
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function subscribe(User $user) {
        return $this->create([
            'user_id' => $user->id
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
