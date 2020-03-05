<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 26 Nov 2018 08:52:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserInvoice
 * 
 * @property int $id
 * @property int $user_id
 * @property string $invoice_id
 * @property string $status
 * @property string $currency_code
 * @property string $invoice_date
 * @property string $sub_total
 * @property string $total
 * @property string $customer_name
 * @property string $customer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class InvoiceUser extends Eloquent
{
	protected $table = "invoice_user";

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'invoice_id',
		'number',
		'status',
		'currency_code',
		'invoice_date',
		'sub_total',
		'total',
		'customer_name',
		'customer_id',
		'invoice_url'
	];
}
