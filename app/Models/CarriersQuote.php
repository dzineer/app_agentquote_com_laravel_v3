<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarriersQuote extends Model
{
    protected $table = 'carriers_quote';

    protected $fillable = [
        'quote_id',
        'data'
    ];
}
