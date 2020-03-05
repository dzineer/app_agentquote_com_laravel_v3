<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 26 Nov 2018 10:05:15 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InvoiceItemUser
 * 
 * @property int $id
 * @property int $item_id
 * @property string $code
 * @property string $quantity
 * @property string $discount_amount
 * @property string $tax_name
 * @property string $description
 * @property string $item_total
 * @property string $tax_id
 * @property string $tax_type
 * @property string $price
 * @property string $product_id
 * @property string $account_name
 * @property string $name
 * @property string $tax_percentage
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class InvoiceItemUser extends Eloquent
{
	protected $table = 'invoice_item_user';

	protected $casts = [
		'item_id' => 'int'
	];

	protected $fillable = [
		'item_id',
		'invoice_id',
		'code',
		'quantity',
		'discount_amount',
		'tax_name',
		'description',
		'item_total',
		'tax_id',
		'tax_type',
		'price',
		'product_id',
		'account_name',
		'name',
		'tax_percentage'
	];
}
