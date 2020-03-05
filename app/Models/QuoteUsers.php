<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class QuoteUsers extends Model
{
    protected $table = 'quotes_user';

    protected $fillable = [
        'affiliate_id',
        'user_id',
        'age',
        'age_or_date',
        'state',
        'month',
        'day',
        'year',
        'gender',
        'term',
        'tobacco',
        'benefit',
        'period',
        'category',
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'user'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
