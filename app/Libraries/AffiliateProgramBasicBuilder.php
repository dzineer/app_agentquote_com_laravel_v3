<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-23
 * Time: 12:56
 */

namespace App\Libraries;

use App\Models\Affiliate;
use App\Models\AffiliateBillingCoupon;
use App\Models\AffiliateCoupon;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class AffiliateProgramCompleteBuilder
 * @package App\Libraries
 */
class AffiliateProgramBasicBuilder implements AppBuilder {
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	private $fields;

    const AFFILIATE_USER = 2;
    const MY_MOBILE_LIFE_QUOTER = 1;

	/**
	 * AffiliateProgramBasicBuilder constructor.
	 *
	 * @param $fields
	 */
	public function __construct($fields) {
		$this->fields = $fields;
	}

	/**
	 * @return mixed|void
	 */
	public function build() {

        $newUser = [
            "type_id" => self::AFFILIATE_USER,
            "lname" => $this->fields['lname'],
            "fname" => $this->fields['fname'],
            "name" => $this->fields['name'],
            "email" => $this->fields['email'],
            "password" => Hash::make($this->fields['password'])
        ];

        $newUser['password'] =  Hash::make($this->fields['password']);
        $newUser = User::create($newUser);

        $newAffiliate = Affiliate::create([
            "name" => $this->fields['name']
        ]);

        $affiliateCoupon = AffiliateCoupon::create([
            'affiliate_id' => $newAffiliate->id,
            "coupon" => $this->fields['code'],
            'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
        ]);

        $group = AffiliateGroup::create([
            'affiliate_id' => $newAffiliate->id,
            'name' => $this->fields['name'],
            'description' => $this->fields['name'],
        ]);

        $affgroupUser = AffiliateGroupUser::create([
            "affiliate_id" => $newAffiliate->id,
            "group_id" => $group->id,
            "user_id" => $newUser->id,
        ]);

        $affBBillingCoupon = AffiliateBillingCoupon::create([
            'affiliate_coupon_id' => $affiliateCoupon->id,
            'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
        ]);

        $newUser->affiliate_id = $newAffiliate->id;
        $newAffiliate->user_id = $newUser->id;

        $newUser->save();
        $newAffiliate->save();
	}
}