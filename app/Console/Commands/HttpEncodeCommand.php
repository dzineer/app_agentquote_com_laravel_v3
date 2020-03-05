<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class HttpEncodeCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'string:encode {string}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encode string';
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

        $hash = strtoupper(sha1( $string ));
        $this->info( 'Hash: ' . $hash );
        $hash = base64_encode($hash);
        $this->info( 'Base64: ' . $hash );

        return true;
    }
}
