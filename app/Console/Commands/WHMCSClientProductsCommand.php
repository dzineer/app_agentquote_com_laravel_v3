<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Libraries\WHMCS\WHMCSApi;

class WHMCSClientProductsCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whmcs:clientproducts {u} {p} {client_id}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List WHMCS Payment Methods';
    private $data;
    private $dataClient;
    private $user;
    private $pass;
    private $client_id;
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
        $this->client_id = $this->argument('client_id');

        // var_dump(\json_encode($tables_struct));

        $this->getClient();

        if ($this->dataClient['result'] === 'success') {
            //  $this->info( print_r($this->data, true) );
            $this->info( "-  name: " . $this->dataClient['client']['firstname'] . " " . $this->dataClient['client']['lastname'] );
        } else {
            $this->error( 'Connected not successful.' );
            $this->error( $this->dataClient['message'] );
            $this->info( print_r($this->dataClient, true) );
            return true;
        }

        $this->getClientProducts();

        if ($this->data['result'] === 'success') {
            $this->info( 'Connected successfully.' );
          //  $this->info( print_r($this->data, true) );
            $this->generateTable();
        } else {
            $this->error( 'Connected not successful.' );
            $this->error( $this->data['message'] );
            $this->info( print_r($this->data, true) );
            return true;
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

    private function getClientProducts() {

        $this->data = WHMCSApi::action_request_with_params(
            $this->endpoint,
            'GetClientsProducts',
            $this->user,
            $this->pass,
            [ "client_id" => $this->client_id ],
            'json'
        );

    }

    private function getClient() {

        $this->dataClient = WHMCSApi::action_request_with_params(
            $this->endpoint,
            'GetClientsDetails',
            $this->user,
            $this->pass,
            [ "clientid" => $this->client_id ],
            'json'
        );

    }

}
