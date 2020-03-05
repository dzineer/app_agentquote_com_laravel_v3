<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Libraries\Google\Api\GooglePageInsight;

class GooglePageInsightCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:pageinsight {apiKey} {domain}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Domain with Google PageInsight';
    private $apiKey;
    private $domain;

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
        $this->apiKey = $this->argument( 'apiKey' );
        $this->domain = $this->argument('domain');

        $data = $this->runPagespeed();

        if ($data['success']) {
            // echo json_encode($data);
            $this->lightHouseResults( $data['message']['lighthouseResult'] );
        } else {
            $this->error( "Error: " . $data['message'] );
        }

        return true;
    }

    public function lightHouseResults( $data ) {
        $requestedURL = $data['requestedUrl'];
        $finalURL = $data['finalUrl'];
        $userAgent = $data['userAgent'];
        $fetchTime = $data['fetchTime'];
        $environment = $this->getEnvironment( $data['environment'] );
        if (count($data['runWarnings'])) {
            echo "\n" . print_r($data['runWarnings'], true) . "\n";
        } else {
            echo "\nNo runWarnings!";
        }
        $this->checkAudits( $data['audits'] );

    }

    public function checkAudits( $audits ) {
        $score = 0;
        echo "\n\n";

        foreach( $audits as $auditKeyName => $auditPoints ) {
            echo "----- " . $auditKeyName . " -----";
            foreach( $auditPoints as $auditKeyPoint => $auditValue ) {
                if ( ! is_array($auditValue)) {
                    echo "\n" . $auditKeyPoint . " : " . $auditValue;
                }
                if ($auditKeyPoint === 'score') {
                    $score += intval( $auditValue );
                }
            }
            echo "\n\n";
        }

        echo "---- Score ---- ";
        echo $score;
        echo "\n\n";
        echo "\n\n";
    }

    public function getEnvironment( $data ) {
        return ["benchmarkIndex" => $data['benchmarkIndex'] ];
    }

    private function generateTable() {

    }

    private function runPagespeed() {

        $api = new GooglePageInsight();
        return $api->runPagespeed($this->apiKey, $this->domain);

    }

}
