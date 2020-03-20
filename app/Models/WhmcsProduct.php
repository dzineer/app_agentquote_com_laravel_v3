<?php

namespace App\Models;

/**
 * Class WhmcsProduct
 *
 * @package App\Models
 */
class WhmcsProduct extends Model
{
    protected $table = 'whmcs_products';

    protected $fillable = [
		'id' ,
        'pid',
		'name' ,
		'class',
		'local_product_id',
		'active'
	];
}
