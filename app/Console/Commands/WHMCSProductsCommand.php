<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Libraries\WHMCS\WHMCSApi;

class WHMCSProductsCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whmcs:products {u} {p}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List WHMCS Payment Methods';
    private $data;
    private $user;
    private $pass;
    private $endpoint = 'https://app.trancehosting.com/includes/api.php';

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
        $this->user = $this->argument( 'u' );
        $this->pass = $this->argument('p');

        // var_dump(\json_encode($tables_struct));

        $this->getPaymentMethods();

        if ($this->data['result'] === 'success') {
            $this->info( 'Connected successfully.' );
          //  $this->info( print_r($this->data, true) );
            $this->generateTable();
        } else {
            $this->error( 'Connected not successful.' );
            $this->error( $this->data['message'] );
            $this->info( print_r($this->data, true) );
        }

        return true;
    }

    private function generateTable() {
       // $bar = $this->output->createProgressBar(count($this->data['paymentmethods']));
      //  $bar->start();
        $this->info( "Products: " );
        for($i=0; $i < $this->data['totalresults']; $i++) {
            $this->info( "- " . $this->data['products']['product'][$i]['name'] );
        }
      //  $bar->finish();
    }

    private function getPaymentMethods() {

        $this->data = WHMCSApi::action_request(
            $this->endpoint,
            'GetProducts',
            $this->user,
            $this->pass,
            'json'
        );

    }

}
