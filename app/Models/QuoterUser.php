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
        'category_id',
        'user_id'
    ];

    protected $with = [
        'category'
    ];

    /**
     * @param \App\User $user
     * @param int $category_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function subscribe(User $user, $category_id) {
        return $this->create([
            'user_id' => $user->id,
            'category_id' => $category_id
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
