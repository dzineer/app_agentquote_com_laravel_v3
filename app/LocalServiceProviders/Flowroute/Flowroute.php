<?php

namespace App\LocalServiceProviders\Flowroute;

use GuzzleHttp;

/**
 * Class Flowroute
 * @package NotificationChannels\Flowroute
 */
class Flowroute
{
    private $debug = true;
    use \App\Libraries\Utilities\AQLogger;

    /** @var string */
    protected $access_key;

    /** @var string */
    protected $secret_key;

    /** @var string */
    protected $from;

    /** @var false | string */
    protected $send_to_override;

    /** @var string */
    public $webhook_url;

    /** @var \GuzzleHttp\Client */
    protected $c;

    /** @var */
    protected $lastMessageTime;

    /**
     * Create a new Flowroute RestAPIinstance.
     *
     */
    public function __construct($config)
    {

        // $config = config('services.flowroute');

        $this->AQLog( "::__construct : " . json_encode($config) );

        $this->access_key = $config['access_key'];
        $this->secret_key = $config['secret_key'];
        $this->from = $config['from_number'];
        $this->send_to_override = $config['send_to_override'] ?? null;
        $this->webhook_url = $config['webhook_url'];

        $this->c = new GuzzleHttp\Client([
            'base_uri' => 'https://api.flowroute.com/v2.1/',
        ]);
    }

    /**
     * Number SMS is being sent from.
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * @param $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function sendSms($data)
    {
        if ($this->send_to_override) $data['to'] = $this->send_to_override;
        return $this->post('messages', $data);
    }


    /**
     * @param $mdr
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function getMdr($mdr)
    {
        return $this->get('messages/' . $mdr);
    }

    /**
     * @param $url
     * @param $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    protected function get($url) {
        return $this->request('GET', $url);
    }

    /**
     * @param $url
     * @param $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    protected function post($url, $data)
    {
        if (!is_string($data)) {
            $data = json_encode($data);
        }

        return $this->request('POST', $url, ['body' => $data]);
    }

    /**
     * @param $method
     * @param $url
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    protected function request($method, $url, $options = [])
    {
        $options = array_merge([
            'auth' => [ $this->access_key, $this->secret_key ],
            'headers' => ['content-type' => 'application/vnd.api+json']
        ], $options);

        $now = microtime(true);

        if ($now - $this->lastMessageTime < 1) {
            $sleepFor = ($now - $this->lastMessageTime) * 1000;
            // \Log::debug("[FLOWROUTE] Sleeping for $sleepFor to prevent throttling");
            usleep($sleepFor);
        }

        $this->lastMessageTime = microtime(true);

        return $this->c->request($method, $url, $options);
    }

}
