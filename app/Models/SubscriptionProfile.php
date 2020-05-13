<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 21 Nov 2018 05:43:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SubscriptionProfile
 *
 * @property int $id
 * @property int $user_id
 * @property string $contact_email
 * @property string $logo
 * @property string $portrait
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $company
 * @property string $contact_phone
 * @property string $contact_addr1
 * @property string $contact_addr2
 * @property string $contact_city
 * @property string $contact_state
 * @property string $contact_zip
 * @property string $position_title
 *
 * @package App\Models
 */
class SubscriptionProfile extends Eloquent
{
	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'subscription_id',
		'contact_email',
		'logo',
		'portrait',
		'company',
		'contact_phone',
		'contact_addr1',
		'contact_addr2',
		'contact_city',
		'contact_state',
		'contact_zip',
		'position_title',
		'facebook_link',
		'twitter_link',
		'youtube_link',
		'linkedin_link',
		'instagram_link',
		'calendly_link'
	];

	public function getFields() {
	    return $this->fillable;
    }
}
