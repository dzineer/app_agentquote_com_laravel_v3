<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendAppNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dzineer:notify {name} {title} {body}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('queuing notification...');
        $notificationClass = ucwords($this->argument('name')) . "Notification";
        $title = $this->argument('title');
        $body = $this->argument('body');
        $icon = '/images/aq-notifications-icon.png';

        $className = 'App\\Notifications\\' . $notificationClass;
        $class_file = app_path('Notifications/'.$notificationClass) . '.php';
        $this->info("finding class " . $className);
        if (file_exists($class_file)) {

           $users = \DB::table('users')
                ->leftJoin('push_subscriptions', 'push_subscriptions.user_id', '=', 'users.id')
                ->where("push_subscriptions.user_id", "<>", "null")
                ->get();

            $user = User::find(4);

            $notification = new $className([$user], $title, $body, function($id, $notification, $canNotify) {
                // dd([$id, $notification, $canNotify]);
            }, \App\Events\ExampleEvent::class);

            Notification::send($user, $notification);

           // event(new OrderShipped($order));

            $this->info("Notification queued.");

        } else {
            $this->error($class_file . " not found!");
        }

        // dd($class);


        // dd($notification_stub);
    }
}
