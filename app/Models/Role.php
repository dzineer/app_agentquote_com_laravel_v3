<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $with = [ 'dashboard' ];

	public function permissions() {
		return $this->belongsToMany(Permission::class);
	}

    public function dashboard() {
        return $this->hasOne(DashboardRole::class);
    }

	/**
	 * @param Permission $permission
	 *
	 * @return Model
	 */
	public function givePermissionTo(Permission $permission) {
		return $this->permissions()->save($permission);
	}
}
