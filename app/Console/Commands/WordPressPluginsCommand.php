<?php

namespace App\Console\Commands;

use App\Libraries\WordPress\Api\WordPressPlugins;
use App\User;
use Illuminate\Console\Command;

class WordPressPluginsCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordpress:plugins {url}';
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

        $data = $this->getWordPressPlugins();

        return true;
    }

    private function getWordPressPlugins() {

        $api = new WordPressPlugins();
        return $api->getPlugins($this->url);

    }

}
