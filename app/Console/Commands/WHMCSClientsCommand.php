<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Libraries\WHMCS\WHMCSApi;
// use dekor\ArrayToTextTable;

class WHMCSClientsCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whmcs:clients {u} {p} {client_id}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List All WHMCS Clients';
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

        $this->getClients();


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
        $this->info( "Clients: " );

        $clients = [];

        $clientIds = [];

        for($i=0; $i < $this->data['totalresults']; $i++) {
            $clientIds[] = $this->data['clients']['client'][$i]['id'];
            $clients[] = [
                "#" => $this->data['clients']['client'][$i]['id'],
                "First Name" => $this->data['clients']['client'][$i]['firstname'],
                "Last Name" => $this->data['clients']['client'][$i]['lastname'],
                "Status" => $this->data['clients']['client'][$i]['status']
            ];
        }

        $this->table(['#', 'First Name', 'Last Name', 'Status'], $clients );
/*        $this->table(['#', 'Command'], [
            [ '#' => 1, 'Command '=> 'New' ],
            [ '#' => 2, 'Command '=> 'Edit' ],
            [ '#' => 3, 'Command '=> 'Delete' ],
        ] );*/
        // $this->choice('Choose a command: ', ['New','Edit','Delete'] );
        $answer =  $this->ask('Choose a customer');

        $userArrayMap = [
          "firstname" => "First Name",
          "lastname" => "Last Name",
          "email" => "Email",
          "companyname" => "Company",
          "status" => "Status",
        ];

        $customer = [];

        if (in_array($answer, $clientIds)) {
            $customDetails = $this->getClientDetails( $answer );
            if ($customDetails['result'] === 'success') {
                    $client = $customDetails['client'];
                    $productsData = $this->getClientProducts($client['id']);
                    $mappedClient = array_map(function($client) use($userArrayMap) {
                    $c = null;

                    foreach($client as $key => $val) {
                        if ( isset($userArrayMap[$key]) ) {
                            $c[ $userArrayMap[$key] ] = $client[$key];
                        }

                    }
                    return $c;
                }, [$client] );

               // $this->info( print_r($mappedClient,true) );
                // $this->info( print_r($mappedClient,true) );
               $this->table( array_keys($mappedClient[0]), $mappedClient );
               $productsNames = [];



               if ($productsData['result'] === 'success') {
                   for($i=0; $i < $productsData['totalresults']; $i++) {
                       // $this->info( "- " . $productsData['products']['product'][$i]['name'] );
                       $productsNames[] =  [
                           "Products" => $productsData['products']['product'][$i]['name'],
                           "Monthly Costs" => $productsData['products']['product'][$i]['recurringamount']
                       ];
                   }
                   // $this->info( print_r($productsNames,true) );
                   $this->table( (array) ['Products','Monthly Costs'], $productsNames );
               }

                $productsCheck = $this->hasProducts( ['Base Product', 'Add On Product 1'], $productsData );

                $this->info( print_r($productsCheck,true) );
               // exit;

                if ($productsCheck['Base Product']) {
                    echo "\nBase Product found.\n";
                    if ($productsCheck['Add On Product 1']) {
                        echo "\nSorry you already have product: Add On Product 1.\n";
                    } else {
                        echo "\nAdd On Product 1 not found, can add.\n";
                        echo "\nProduct Id: " . '40' . "\n";
                        $this->addClientProduct( $this->client_id, 40 );
                    }
                } else {
                    echo "\nSorry you must have product: Base Product, before upgrading.\n";
                }

            }

        }


      //  $bar->finish();
    }

    private function hasProducts( $names, $productsData ) {
        $productsFound = [];
        foreach($names as $name) {
            $productsFound[ $name ] = false;
            $this->info( "checking " . $name );
            for($i=0; $i < $productsData['totalresults']; $i++) {
                $this->info( "- " . $productsData['products']['product'][$i]['name'] );

                if ($name === $productsData['products']['product'][$i]['name']) {
                    $this->info( "- " . $productsData['products']['product'][$i]['name'] );
                    $productsFound[ $name ] = true;
                }
            }
        }

        $this->info( print_r($productsFound,true) );


        return $productsFound;
    }

    private function addClientProduct( $client_id, $product_id ) {

        $info = WHMCSApi::action_request_with_params(
            $this->endpoint,
            'AddOrder',
            $this->user,
            $this->pass,
            [ "clientid" => $client_id, "paymentmethod" => 'stripe', 'pid' => [$product_id] ],
            'json'
        );

        // echo print_r(json_encode($info,true),true); exit;

        return $info;

    }

    private function getClientProducts( $client_id ) {

        $info = WHMCSApi::action_request_with_params(
            $this->endpoint,
            'GetClientsProducts',
            $this->user,
            $this->pass,
            [ "clientid" => $client_id ],
            'json'
        );

        // echo print_r(json_encode($info,true),true); exit;

        return $info;

    }

    private function getClients() {

        $this->data = WHMCSApi::action_request(
            $this->endpoint,
            'GetClients',
            $this->user,
            $this->pass,
            'json'
        );

    }

    private function getClientDetails( $client_id ) {

        return WHMCSApi::action_request_with_params(
            $this->endpoint,
            'GetClientsDetails',
            $this->user,
            $this->pass,
            ["clientid" => $client_id ],
            'json'
        );

    }

}
