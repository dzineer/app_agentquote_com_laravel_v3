<?php

namespace App\Console\Commands;

use App\Facades\AQLog;
use App\User;
use Illuminate\Console\Command;

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Afosto\Acme\Client;
use Symfony\Component\VarDumper\VarDumper;

class QuoteVerifyCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote {to} {text}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Send a quote verification";

    /**
     * @var array|string|null
     */
    private $from;
    /**
     * @var array|string|null
     */
    private $text;
    /**
     * @var array|string|null
     */
    private $to;

    const MAX_CHECKED_TIMES = 3;
    /**
     * @var int
     */
    private $timesChecked;

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

       // $this->from = $this->argument( 'from' );
        $this->to = $this->argument( 'to' );
        $this->text = $this->argument( 'text' );

        $response = $this->getSMS();

        if ($response["success"]) {
            $this->info("Message delivered");

        } else {
            $this->info("Message not delivered.");
            VarDumper::dump([
                "errors" => $response["errors"]
            ]);
        }

        return true;

    }

    private function getSMS()
    {
        $verify = new \App\Libraries\QuoteVerify();
        $response = $verify->sendStringSMS($this->text, $this->to);

        VarDumper::dump([
            "sending to" => $this->to,
            "body" => $this->text,
            "QuoteVerification::sendOTPSMS - response" => $response,
        ]);

        $this->timesChecked = 0;
        $done = false;

        $data = [];
        $responseData = [];

        if(isset($response['errors'])) {
            $data = ["success" => false, "errors" => $response["errors"] ];
            return $data;
        }

        do {
            // did we get a good response ?

            if (isset($response['data'])) {
                $response = $verify->getSentSMSResponse($response["data"]);
                $responseData = $response['data'];
            }

            VarDumper::dump([
                "response" => $responseData,
            ]);

            if (isset($responseData['attributes'])) {
                if (isset($responseData['attributes']['delivery_receipts'])) {
                    foreach($responseData['attributes']['delivery_receipts'] as $receipt) {

                        VarDumper::dump([
                            "status_code" => $receipt['status_code'],
                        ]);

                        if($receipt['status_code'] === 1003) {
                            $data = ["success" => true, "message" => $receipt["status_code_description"] ];
                            return $data;
                        }
                    }
                }
            }

            // failed, check again until we have reached max number of attempts
            if ($this->timesChecked < self::MAX_CHECKED_TIMES) {
                $this->timesChecked++;
                sleep(10);
            } else {
                $done = true;
            }
        }
        while(!$done);

        // message not sent successfully
        $data = ["success" => false, "errors" => [
            [
                "id" => 0,
                "status" => 0
            ]
        ]];

        return $data;

    }

}
