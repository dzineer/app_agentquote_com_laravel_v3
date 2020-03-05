<?php

namespace App\Notifications;

use App\Actions\Action;
use App\Actions\NewQuoteAction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Class AgentSignupNotification
 *
 * @package App\Notifications
 */
class AgentSignupNotification extends WebPushNotification
{
}
