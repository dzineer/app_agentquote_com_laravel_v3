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
 * Class NewMobileQuoterSubscriptionNotification
 *
 * @package App\Notifications
 */
class NewMobileQuoterSubscriptionNotification extends Notification
{
    use Queueable;

    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $body;

    /**
     * @var
     */
    private $icon;

    /**
     * @var
     */
    private $action;

    /**
     * Create a new notification instance.
     *
     * @param $title
     * @param $body
     * @param $icon
     */
    public function __construct($title, $body, $icon = '/images/aq-notifications-icon.png')
    {
        $this->title = $title;
        $this->body = $body;
        $this->icon = $icon;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', WebPushChannel::class];
    }

    /**
     * @param $notifiable
     * @param $notification
     * @return \NotificationChannels\WebPush\WebPushMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->icon($this->icon)
            ->body($this->body)
            ->action('View Agents', 'notification_action')
            ->data(['id' => $notification->id]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'icon' => $this->icon,
            'action_url' => 'https://app.agentquote.com',
            'created_at' => Carbon::now()->toIso8601String()
        ];
    }
}
