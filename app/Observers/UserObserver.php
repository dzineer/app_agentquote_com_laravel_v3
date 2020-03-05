<?php

namespace App\Observers;

use App\User;

class UserObserver
{
	public function retrieved(User $user) {
		//dd($user->typeable->toArray());
		foreach( $user->typeable->toArray() as $key => $value ) {
			$user->setAttribute($key, $value);
		}
	}


}
