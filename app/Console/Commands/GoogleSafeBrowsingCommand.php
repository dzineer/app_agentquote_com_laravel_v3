<?php

namespace App\Console\Commands;

use App\Libraries\Google\Api\GoogleSafeBrowsing;
use App\User;
use Illuminate\Console\Command;
use App\Libraries\Google\Api\GooglePageInsight;

class GoogleSafeBrowsingCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:safebrowsing {apiKey} {domain}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Domain with Google Safe Browsing';
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

        $data = $this->checkBlacklisting();

        return true;

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

    // Format for google
    public static function formatUrls($urls) {
        $arr = array();
        foreach ($urls as $url) {
            $arr[] = ['url' => $url];
        }
        return $arr;
    }

    private function getClientVersion() {
        return '1.0';
    }

    private function getClientId() {
        return 'https://agentquoter.com';
    }

    private function getThreatTypes() {
        return [
            'THREAT_TYPE_UNSPECIFIED',
            'MALWARE',
            'SOCIAL_ENGINEERING',
            'UNWANTED_SOFTWARE',
            'POTENTIALLY_HARMFUL_APPLICATION'
        ];
    }

    private function getPlatformTypes() {
        return [
            'PLATFORM_TYPE_UNSPECIFIED',
            'WINDOWS',
            'LINUX',
            'ANDROID',
            'OSX',
            'IOS',
            'ANY_PLATFORM'
        ];
    }


    private function getThreatEntryTypes() {
        return [
            "URL"
        ];
    }

    private function checkBlacklisting() {

        $urls = [];

        $urls[] = "https://mobilebooster.co.nz";
        $urls[] = "https://ad-rank.com";

        $payload = [
            'client' => [
                'clientId' => $this->getClientId(),
                'clientVersion' => $this->getClientVersion(),
            ],
            'threatInfo' => [
                "threatTypes"       =>   $this->getThreatTypes(),
                "platformTypes"     =>   $this->getPlatformTypes(),
                "threatEntryTypes" =>  $this->getThreatEntryTypes(),
                "threatEntries" => $this->formatUrls($urls),
            ]
        ];

        $api = new GoogleSafeBrowsing();
        return $api->runThreatLists($this->apiKey, $payload);

    }

}
