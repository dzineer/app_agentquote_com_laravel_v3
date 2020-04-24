<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CleanReportsCommand extends Command
{
    /**
     *
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:generate {name} {--force= : Force the report true | false }';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate report';

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
        $this->info('get started');
        $name = $this->argument('name');
        $force = $this->option('force');
        $this->info('Got the name: ' . $name);
        $this->info('Forcing: '. $force);
    }

    protected function getArguments()
    {
        return [
          ['path', InputOption::VALUE_OPTIONAL, 'Path to the command class to generate.']
        ];
    }

    protected function getOptions()
    {
        return [
            ['path', null, InputOption::VALUE_OPTIONAL, 'Path to start from.', null],
            ['properties', null, InputOption::VALUE_OPTIONAL, 'List of properties to build.', null],
            ['base', null, InputOption::VALUE_OPTIONAL, 'The base directory to run from.', null]
        ];

    }
}
