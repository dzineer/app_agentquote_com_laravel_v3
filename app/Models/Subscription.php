<?php

namespace App\Models;

use App\User;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'product_id',
        'active'
    ];

    public function product() {
      return $this->belongsTo(Product::class);
    }

    public function user() {
      return $this->belongsTo(User::class);
    }

    /**
     * @param \App\User $user
     */
    public function addUser(User $user) {
        $this->users()->create(compact('user'));
    }
}
