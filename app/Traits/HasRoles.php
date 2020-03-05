<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-03-12
 * Time: 16:18
 */

namespace App\Traits;

use App\Role;

trait HasRoles
{
    public function assignRole($role)
    {
        return $this->roles()->save(Role::whereName($role)->firstOrFail());
    }

    public function addRole($name, $label = '')
    {
        $role = new Role;
        $role->name = $name;
        $role->label = $label;
        $role->save();

        return $role;
    }

    public function hasRole($role)
    {

        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        /*    	if (is_array($role)) {
                    foreach ($role as $r) {
                        if ($this->hasRole($r->name)) {
                            return true;
                        }
                    }
                }*/

        return ! ! $role->intersect($this->roles)->count();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


}