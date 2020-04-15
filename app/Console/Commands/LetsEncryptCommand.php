<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Afosto\Acme\Client;
use Symfony\Component\VarDumper\VarDumper;

class LetsEncryptCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'certificate {action} {fs} {domain}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Manage Let's Encrypt Certificates";
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

        if (env('APP_MODE') === 'local') {
            $this->store = env('LOCAL_LETSENCRYPT_CERTIFICATE_STORE');
        } else {
            $this->store = env('LIVE_LETSENCRYPT_CERTIFICATE_STORE');
        }

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        if ($this->validate()) {
            $this->go();
        }

        return true;

    }

    private function validate() {
        if ($this->hasArgument('action')) {

            $this->action = $this->argument( 'action' );
            $this->args[] = $this->action;

            $this->info("Action: $this->action");

            if ($this->hasArgument('fs')) {

                $this->fileSystemName = $this->argument( 'fs' );
                $this->args[] = $this->fileSystemName;
                $this->info("FileSystem: $this->fileSystemName");

            }

            if ($this->hasArgument('domain')) {

                $this->domain = $this->argument( 'domain' );
                $this->args[] = $this->domain;
                $this->info("Domain: $this->domain");

            }

            if (count($this->args) !== self::REQUIRED_ARGUMENTS_LENGTH) {

                $this->error("invalid number of arguments.");
                die(1);

            }

        } else {
            $this->error("a action parameter is required.");
            die(1);
        }

        return $this->args;
    }

    private function go() {
        //Prepare flysystem
        $adapter = new Local('data');
        $filesystem = new Filesystem($adapter);

        // Acct Number: 72153151

        //Construct the client
        $client = new Client([
            'username' => 'frankdd3@gmail.com',
            'fs'       => $filesystem,
            'mode'     => env('APP_MODE') === 'LIVE' ? Client::MODE_LIVE : Client::MODE_STAGING,
        ]);

        $order = $client->createOrder([
            $this->domain
        ]);

        $authorizations = $client->authorize($order);

        // VarDumper::dump($authorizations);

        foreach ($authorizations as $authorization) {
            $txtRecord = $authorization->getTxtRecord();

            $data = [];

            //To get the name of the TXT record call:
            $data['name'] = $txtRecord->getName();

            //To get the value of the TXT record call:
            $data['value'] = $txtRecord->getValue();

            VarDumper::dump($data);

            try {

                try {

                    $api = new \DZResellerClub\Api(
                        new \DZResellerClub\Config(784909, 'GPFOx3p9Y7byCpiZwaP3vtV9QiMbV1c2', true),
                        new \GuzzleHttp\Client()
                    );

                    // $ttl = new \DZResellerClub\TimeToLive(86400);
                    $ttl = new \DZResellerClub\TimeToLive(7200);
                    $request = new \DZResellerClub\Dns\Txt\Requests\SearchRequest(
                        $this->domain,
                        $data['name'],
                        '',// $data['value']
                        $ttl
                    );

                    $response = $api->txtRecord()->search($request);

                    VarDumper::dump($response);

                    die(1);

                    // @todo - Handle the successful response within your codebase.

                } catch(\DZResellerClub\Exceptions\ApiException $e) {
                    // @todo - Handle the exception within your codebase.
                    $this->error($e->getMessage());
                    die(1);
                }

                if ($client->selfTest($authorization, \Afosto\Acme\Client::VALIDATON_DNS)) {
                    sleep(30); // this further sleep is recommended, depending on your DNS provider, see below
                    $client->validate($authorization->getDnsChallenge(), 15);

                    if ($client->isReady($order)) {
                        //The validation was successful.

                        $certificateObject = $client->getCertificate($order);

                        $certificate = $certificateObject->getCertificate();
                        $privateKey = $certificateObject->getPrivateKey();

                        //Store the certificate and private key where you need it

                        $this->storeCertificate($certificate, $privateKey);
                    }

                    //
                } else {
                    throw new \Exception('Count not verify ownership via DNS');
                }

            } catch (\Exception $exception) {
                $this->error($exception->getMessage());
                die(1);
            }

        }

    }

    /**
     * @param string $certificate
     * @param string $privateKey
     */
    private function storeCertificate(string $certificate, string $privateKey, bool $overwrite = true): void
    {
        $certPath = $this->store . '/' . $this->domain;
        $fileCert = $certPath . '/' . 'certificate.cert';
        $filePrivateKey = $certPath . '/' . 'private.key';

        if (!is_dir($certPath)) {
            mkdir($certPath);
        }

        if (is_file($fileCert) && !$overwrite) {
            $this->error("Certificate: " . $fileCert . " already exits!");
        }

        if (is_file($filePrivateKey) && !$overwrite) {
            $this->error("Private key: " . $filePrivateKey . " already exits!");
        }

        file_put_contents($fileCert, $certificate);
        file_put_contents($filePrivateKey, $privateKey);

        if (!is_file($fileCert)) {
            $this->error("Certificate: " . $fileCert . " was not created!");
        }

        if (!is_file($filePrivateKey) && !$overwrite) {
            $this->error("Private key: " . $filePrivateKey . " was not created!");
        }
    }

}
