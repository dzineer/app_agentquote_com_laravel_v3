<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Libraries\WHMCS\WHMCSApi;
// use dekor\ArrayToTextTable;

class WHMCSAddOrderCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whmcs:order {u} {p} {client_id} {product_id}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Order to WHMCS Client';
    private $data;
    private $dataClient;
    private $user;
    private $pass;
    private $client_id;
    private $product_id;
    private $invoice_id;
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
        $this->product_id = $this->argument('product_id');

        // var_dump(\json_encode($tables_struct));

        $this->createClientOrder();

        if ($this->data['result'] === 'success') {
            $this->info( 'Connected successfully.' );
            $this->info( print_r($this->data, true) );

            if (isset($this->data['orderid']) && strlen($this->data['orderid']) ) {
                echo "\nOrder Id: " . $this->data['orderid'];

            }

            if (isset($this->data['invoiceid']) && strlen($this->data['invoiceid']) ) {
                $this->readInvoice();
            }

        } else {
            $this->error( 'Connected not successful.' );
            $this->error( $this->data['message'] );
            $this->info( print_r($this->data, true) );
            return true;
        }

        return true;
    }

    private function createClientOrder() {

        $this->data = WHMCSApi::action_request_with_params(
            $this->endpoint,
            'AddOrder',
            $this->user,
            $this->pass,
            [
                "clientid" => $this->client_id,
                "pid" => $this->product_id,
                "paymentmethod" => 'stripe',
            ],
            'json'
        );

    }

    private function getInvoice() {

        return WHMCSApi::action_request_with_params(
            $this->endpoint,
            'GetInvoice',
            $this->user,
            $this->pass,
            [
                "invoiceid" => $this->invoice_id,
            ],
            'json'
        );

    }

    protected function readInvoice(): void {

        echo "\nInvoice Id: " . $this->data['invoiceid'];
        $this->invoice_id = $this->data['invoiceid'];
        $invoiceData      = $this->getInvoice();
        // $this->info( print_r( $invoiceData, true ) );

        if ( $invoiceData['result'] === 'success' ) {
            $this->info( 'Connected successfully.' );
            $this->info( print_r( $invoiceData, true ) );
            echo "\nInvoice id: " . $invoiceData['items']['item'][0]['id'];
            echo "\nType: " . $invoiceData['items']['item'][0]['type'];
            echo "\nDescription: " . $invoiceData['items']['item'][0]['description'];
            echo "\nAmount: " . $invoiceData['items']['item'][0]['amount'];
            echo "\n";
        } else {
            $this->error( 'Connected not successful.' );
            $this->error( $this->data['message'] );
            $this->info( print_r( $this->data, true ) );
        }
    }
}
