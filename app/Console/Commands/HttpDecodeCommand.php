<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class HttpDecodeCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'string:decode {string}';
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

        $this->info( 'Base64: ' . $string );
        $hash = base64_decode($string);
        $this->info( 'Hash: ' . $hash );

        return true;
    }
}
