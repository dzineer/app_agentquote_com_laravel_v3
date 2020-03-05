<?php

namespace App\Composers;

use App\Models\SuperAd;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationsComposer
{
    protected $notificationsString;

    public function __construct()
    {
        dd(Auth::user());
        $this->notificationsString = json_encode(Auth::user()->notifications);
    }

    public function compose(View $view)
    {
        $view->with('notificationsString', $this->notificationsString);
    }
}