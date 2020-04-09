<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:56:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
use App\Models\CarriersCategoryUser;
/**
 * Class Language
 *
 * @package App\Models
 */
class Language extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'languages';

    /**
     * @var array
     */
    protected $fillable = [
	    'id',
		'name',
		'prefix',
		'sub_tag'
	];

    /**
     * @param $arr
     * @return false|string
     */
    static function arrToJSON($arr) {
		return json_encode($arr);
	}

}
