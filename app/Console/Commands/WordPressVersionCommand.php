<?php

namespace App\Console\Commands;

use App\Libraries\WordPress\Api\WordPressVersion;
use App\User;
use Illuminate\Console\Command;

class WordPressVersionCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordpress:version {url}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check a Website WordPress Version';
    private $url;

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
        $this->url = $this->argument( 'url' );

        $data = $this->getWordPressVersion();

        return true;
    }

    private function getWordPressVersion() {

        $api = new WordPressVersion();
        return $api->getVersion($this->url);

    }

}
