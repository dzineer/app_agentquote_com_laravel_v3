<?php

namespace App\Models;

use App\User;

/**
 * Class LandingPageUser
 *
 * @package App\Models
 */
class LandingPageUser extends Model
{
    protected $table = 'landing_page_users';

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

    public function category()
    {
        return $this->belongsTo(LandingPageCategory::class);
    }

}
