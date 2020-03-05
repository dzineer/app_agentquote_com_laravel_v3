<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class HttpCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'http:hash {string} {--action= : Action to run on string} {--base= : Base to convert result to}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash string';
    protected $parser;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $string = $this->argument( 'string' );
        $action = $this->option('action');
        $base = $this->option('base');

        $hash = sha1( $string );

        if ($action) {
            switch($action) {
                case 'lowercase':
                    $hash = strtolower($hash);
                    break;
                case 'uppercase':
                    $hash = strtoupper($hash);
                    break;
                default:
            }
        }

        if ($base) {
            switch($base) {
                case '64':
                    $hash = base64_encode($hash);
                    break;
                default:
            }
        }

        // var_dump(\json_encode($tables_struct));

        $this->info( 'Connected successfully' );
        $this->info( 'Hash ' . $hash );

        return true;
    }
}
