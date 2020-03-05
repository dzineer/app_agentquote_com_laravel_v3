<?php

namespace App\Models;

use App\User;

/**
 * Class LandingPageCategory
 *
 * @package App\Models
 */
class LandingPageCategory extends Model
{
    protected $table = 'landing_page_categories';

    protected $fillable = [
        'category',
        'token',
    ];

}
