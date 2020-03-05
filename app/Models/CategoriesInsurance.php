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
 * Class CategoriesInsurance
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class CategoriesInsurance extends Eloquent
{
	protected $table = 'categories_insurance';

	protected $fillable = [
		'name'
	];

	static function removeCarrier( $userId, $carrierId, $categoryId ) {
		return CarriersCategoryUser::where([
			["user_id", "=", $userId],
			["company_id", "=", $carrierId],
			["category_id", "=", $categoryId],
		])->delete();
	}

	static function addCarrier( $userId, $carrierId, $categoryId ) {
		$tmp = new CarriersCategoryUser();
		$tmp->user_id = $userId;
		$tmp->company_id = $carrierId;
		$tmp->category_id = $categoryId;
		return $tmp->save();
	}

	static function getCarriers( $userId, $categoryId ) {
		$query = "SELECT cc.category_id, cc.company_id, c.name, c.link1, c.link2, (CASE WHEN ccu.user_id IS NOT NULL THEN 1 ELSE 0 END) as selected 
					FROM carriers_categories cc
						LEFT JOIN carriers_category_users ccu ON(ccu.category_id = cc.category_id AND ccu.company_id = cc.company_id AND ccu.user_id = {$userId})
						LEFT JOIN carriers c ON(c.company_id = cc.company_id)
							WHERE cc.category_id = {$categoryId} AND c.active = 1 ORDER BY c.name ASC";

		//echo "<pre>" . $query . "</pre>";

		$output = DB::select($query);
		return $output;
		// return CategoriesInsurance::arrToJSON($output);
	}

	static function getUnderwrittenTermCarriers() {
	    return self::getCategoryCarriers(1);
    }

	static function getSitCarriers() {
	    return self::getCategoryCarriers(2);
    }

	static function getSiwlCarriers() {
	    return self::getCategoryCarriers(4);
    }

    static function getCategoryCarriers( $categoryId ) {
        $query = "SELECT cc.category_id, cc.company_id, c.name, c.link1, c.link2, 1 as selected
					FROM carriers_categories cc
						LEFT JOIN carriers c ON(c.company_id = cc.company_id)
							WHERE cc.category_id = {$categoryId} AND c.active = 1 ORDER BY c.name ASC";

        //echo "<pre>" . $query . "</pre>";

        $output = DB::select($query);
        return $output;
        // return CategoriesInsurance::arrToJSON($output);
    }

	static function arrToJSON($arr) {
		return json_encode($arr);
	}

}
