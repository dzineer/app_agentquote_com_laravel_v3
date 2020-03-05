<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeWebNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:web-notification {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Web App Notification.';

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
        $this->info('building new web notification...');
        $notification_stub = file_get_contents(app_path('Notifications/Templates/web-notification.stub'));

        $notification_name = ucwords($this->argument('name')).'Notification';

        $notification_stub = str_replace("{{CLASS}}", $notification_name, $notification_stub);
        file_put_contents(app_path('Notifications/'.$notification_name . '.php'), $notification_stub);
        $this->info('done.');
    }
}
