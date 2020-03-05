<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuoteUnverified extends Model
{

    use Notifiable;

    protected $table = 'quote_unverified';

    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'name',
        'token',
        'code',
        'domain',
        'attempts',
        'data',
        'lock',
        'expires_at',
    ];

    protected $dates = ['created_at', 'updated_at', 'expires_at'];

    public function routeNotificationForFlowroute()
    {
        // Country code, area code and number without symbols or spaces
        return preg_replace('/\D+/', '', $this->phone);
    }
}
