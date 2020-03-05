<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model;

class AffiliateGroupUser extends Model
{
    protected $table = 'affiliate_group_users';

    protected $with = ['affiliate_group'];

    protected $fillable = [
        'affiliate_id',
        'group_id',
        'user_id',
    ];

    public function affiliate_group() {
        return $this->hasMany(AffiliateGroup::class, 'affiliate_id', 'affiliate_id');
    }

}
