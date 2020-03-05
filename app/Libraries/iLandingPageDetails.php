<?php

namespace App\Libraries;
// Landing Page Wrapper
interface iLandingPageDetails
{
    public function setLandingPageUserCategory( $v );
    public function getLandingPageUserCategory();
    public function setGACode( $v );
    public function getGACode();
}