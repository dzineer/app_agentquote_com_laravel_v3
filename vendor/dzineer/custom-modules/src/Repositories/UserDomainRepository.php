<?php

namespace Dzineer\CustomModules\Repositories;

use Dzineer\LandingPages\Models\UserDomain;

class UserDomainRepository
{
	public function getUserDomains($userid) {
		$domainRecords =  UserDomain::where("user_id", $userid);
		if( $domainRecords->exists() ) {
			return $domainRecords->get()->pluck('domain')->toArray();
		}
		return null;
	}
}