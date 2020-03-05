<?php

namespace App\Notifications;

use App\Actions\Action;
use App\Actions\NewQuoteAction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
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
class WebPushNotification extends Notification
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
     * @var null
     */
    private $cb;

    private $event;

    private $users;

    private $singleUser = true;

    private $toNotify = false;

    /**
     * Create a new notification instance.
     *
     * @param $users
     * @param $title
     * @param $body
     * @param null $cb
     * @param null $event
     */
    public function __construct($users, $title, $body, $cb = null, $event = null)
    {
        $this->users = $users;
        // do we have more than 1 user subscribed to this event?
        $this->singleUser = count($users) === 1;
        $this->title = $title;
        $this->body = $body;
        $this->icon = config('agentquote.notifications.icon');
        $this->cb = $cb;
        $this->event = $event;

        $this->canNotify();
    }

    private function canNotify() {

        if ($this->singleUser) {
            if ($this->users[0]->notification_permission) {
                $this->toNotify = (!! $this->users[0]->notification_permission->notifications_enabled);
            }
        }

        return $this->toNotify;
    }

    public function setIcon($icon) {
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
        // Notification Id Saved to DB: $this->id

        /*
            dd($notifiable);
        ---------------------------------------------------------------
            App\Notifications\AgentSignupNotification {#989
              -title: "New Signup"
              -body: "New Agent Signup"
              -icon: "/images/aq-notifications-icon.png"
              -action: null
              -cb: Closure($id, $notification) {#938
                class: "App\Console\Commands\SendAppNotifications"
                this: App\Console\Commands\SendAppNotifications {#913 …}
                parameters: {
                  $id: {}
                  $notification: {}
                }
                file: "./app/Console/Commands/SendAppNotifications.php"
                line: "61 to 63"
              }
              +id: "c8b4728a-c2c7-4d5e-9c65-bc75a04032c5"
              +locale: null
              +connection: null
              +queue: null
              +chainConnection: null
              +chainQueue: null
              +delay: null
              +chained: []
            }
        ---------------------------------------------------------------
        */

       // if (!! $user->notification_permission->notifications_enabled) {

        if ($this->toNotify) {
            if ( $this->event ) {
                broadcast(new $this->event($notification));
            }
        }

        if ($this->cb) {
            call_user_func($this->cb, $this->id, $notification, $this->toNotify);
        }

       // broadcast(new \App\Events\ExampleEvent($notification));

        return (new WebPushMessage)
            ->title($this->title)
            ->icon($this->icon)
            ->body($this->body)
            ->action('View Agents', 'notification_action')
            ->data(['id' => $notification->id]);
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'invoice_id' => '1223232',
            'amount' =>'400.00',
        ]);
    }

    public function broadcastOn()
    {
        return 'notifications';
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
