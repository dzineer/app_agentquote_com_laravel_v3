<?php

namespace App\Composers;

use App\Models\SuperAd;
use Illuminate\View\View;

class SuperAdComposer
{
    protected $adString;

    public function __construct(SuperAd $ad)
    {
        $adInst = $ad->first();
        $this->adString = json_encode($adInst);
    }

    public function compose(View $view)
    {
        $view->with('superAdString', $this->adString);
    }
}