<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeAppNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:app-notification {name} {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Web App Notification and Action.';

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
        $this->info('building notification and action...');
        $notification_stub = file_get_contents(app_path('Notifications/Templates/webpush-notification.stub'));
        $action_stub = file_get_contents(app_path('Actions/Templates/webpush-notification-action.stub'));

        $notification_name = ucwords($this->argument('name')).'Notification';
        $action_name = ucwords($this->argument('action')).'Action';

        $notification_stub = str_replace("{{CLASS}}", $notification_name, $notification_stub);
        $notification_stub = str_replace("{{ACTION_CLASS}}", $action_name, $notification_stub);
        $action_stub = str_replace("{{CLASS}}", $action_name, $action_stub);
        file_put_contents(app_path('Actions/'.$action_name . '.php'), $action_stub);
        file_put_contents(app_path('Notifications/'.$notification_name . '.php'), $notification_stub);
        $this->info('done.');
        // dd($notification_stub);
    }
}
