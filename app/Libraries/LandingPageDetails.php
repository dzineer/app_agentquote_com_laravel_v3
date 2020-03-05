<?php

namespace App\Libraries;
// Landing Page Wrapper
class LandingPageDetails implements iLandingPageDetails
{
    private $landingPageUser = null;
    private $gaCode = null;

    public function setLandingPageUserCategory( $v ) {
        $this->landingPageUser = $v;
    }

    public function getLandingPageUserCategory() {
        return $this->landingPageUser;
    }

    public function setGACode( $v ) {
        $this->gaCode = $v;
    }

    public function getGACode() {
        return $this->gaCode;
    }



}