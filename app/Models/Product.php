<?php

namespace App\Models;

use App\User;

/**
 * Class Product
 *
 * @package App\Models
 */
class Product extends Model
{
    protected $fillable = [
		'id',
        'name',
		'description',
		'menu_path',
		'active'
    ];
    
    /**
     * @var array
     */
    protected $casts = [
        'active' => 'bool'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    /**
     * @param \App\User $user
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function subscribe(User $user) {
        return $this->subscriptions()->create([
            'user_id' => $user->id,
            'product_id' => $this->id
        ]);
    }

     /**
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function hasSubscription($user_id) {
        return $this->subscriptions()->where([
            'user_id' => $user_id,
            'product_id' => $this->id
        ])->exists();
    }

    /**
     * @return mixed
     */
    public function isActive() {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function notActive() {
        return ! $this->active;
    }

    /**
     *
     */
    public function activate() {
        $this->update( [ 'active' => true ] );
    }

    /**
     *
     */
    public function deActivate() {
        $this->update( [ 'active' => false ] );
    }

}
