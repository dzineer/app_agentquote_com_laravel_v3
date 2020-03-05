<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadsUser extends Model
{
	public function contact() {
		// ModelClass, id in UserContact, contact_id in ModelClass
		return $this->hasOne(ContactUser::class, 'id', 'contact_id');
	}

	public function quote() {
		// ModelClass, id in UserContact, contact_id in ModelClass
		return $this->hasOne(QuoteUser::class, 'id', 'quote_id');
	}
}
