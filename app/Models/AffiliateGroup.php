<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model;

class AffiliateGroup extends Model
{
    protected $table = 'affiliate_groups';

    protected $fillable = [
        'affiliate_id',
        'name',
        'description',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'affiliate_id' => 'int',
        'name' => 'string',
        'description' => 'string'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}
