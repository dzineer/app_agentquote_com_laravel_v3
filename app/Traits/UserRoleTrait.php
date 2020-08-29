<?php

namespace App\Traits;

trait UserRoleTrait
{
    public function is_super_super() {
        return $this->type_id === 999;
    }

    public function is_super() {
        return $this->type_id === 1;
    }

    public function is_affiliate() {
        return $this->type_id === 2;
    }

    public function is_admin() {
        return $this->type_id === 3;
    }

    public function is_manager() {
        return $this->type_id === 4;
    }

    public function is_agent() {
        return $this->type_id === 5;
    }
}
