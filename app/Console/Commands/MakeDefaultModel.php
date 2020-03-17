<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDefaultModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dzmodel {name} {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Default Eloquent model class quicker.';

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
        $this->info('building app model and action...');
        $model_stub = file_get_contents(app_path('Models/Templates/model.stub'));

        $model_name = ucwords($this->argument('name'));
        $table_name = strtolower($this->argument('table'));

        $model_stub = str_replace("{{CLASS}}", $model_name, $model_stub);
        $model_stub = str_replace("{{TABLE}}", $table_name, $model_stub);
        file_put_contents(app_path('Models/'.$model_name . '.php'), $model_stub);
        $this->info('done.');
    }
}
