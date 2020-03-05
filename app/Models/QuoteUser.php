<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserQuote
 *
 * @property int $id
 * @property int $user_id
 * @property string $birthdate
 * @property string $gender
 * @property string $smoker
 * @property string $product_category
 * @property int $term
 * @property string $coverage
 * @property int $company_id
 * @property string $product_id
 * @property string $premium_monthly
 * @property string $premium_quarterly
 * @property string $premium_semiannually
 * @property string $premium_annually
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class QuoteUser extends Eloquent
{
    protected $table = 'quotes_user';

	protected $casts = [
		'user_id' => 'int',
		'term' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'birthdate',
		'gender',
		'smoker',
		'product_category',
		'term',
		'coverage',
		'company_id',
		'product_id',
		'premium_monthly',
		'premium_quarterly',
		'premium_semiannually',
		'premium_annually'
	];
}
