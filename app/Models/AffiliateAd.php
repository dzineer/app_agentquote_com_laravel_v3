<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateAd extends Model
{
    protected $table = 'affiliate_ads';

    protected $with = [
        'category'
    ];

    protected $fillable = [
        'affiliate_id',
        'category_id',
        'company_id',
/*        'body',
        'link',*/
        'message',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'affiliate_id' => 'int',
        'category_id' => 'int',
        'company_id' => 'int',
        'body' => 'string',
        'link' => 'string'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function category() {
        return $this->belongsTo(CategoriesInsurance::class, 'category_id', 'category_id');
    }
}