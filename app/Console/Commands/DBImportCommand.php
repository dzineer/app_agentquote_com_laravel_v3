<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Afosto\Acme\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\VarDumper\VarDumper;

class DBImportCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbimport {action} {file}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import Customer Data";
    private $user;
    /**
     * @var array|string|null
     */
    private $fileSystemName;
    /**
     * @var array|string|null
     */
    private $domain;
    private $action;
    private const REQUIRED_ARGUMENTS_LENGTH = 3;
    private $args = [];
    private $store;

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

        $this->dispatcher();

        return true;

    }

    protected function dispatcher()
    {
        $this->action = $this->argument('action');

        switch ($this->action) {
            case 'report':
                return $this->report();

            default:
        }
    }

    protected function report()
    {
        $file = $this->argument('file');
        $rawData = $this->readData($file);
        $data = $this->formatData($rawData);

        $tables = [];

        foreach($data as $item) {
            if ($item['type'] === 'table') {
                dd($item['type']);
             // $tables[] = $item['name'];
            }
        }

        // dd($tables);

    }

    private function readData($file) {
        if (file_exists($file)) {
            return file_get_contents($file);
        }
    }

    private function formatData($contents) {
        return json_encode($contents, true);
    }


}
