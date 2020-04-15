<?php

namespace DZResellerClub\Dns\Txt;

use DZResellerClub\Api;

use DZResellerClub\Dns\Txt\Requests\AddRequest;
use DZResellerClub\Dns\Txt\Requests\UpdateRequest;
use DZResellerClub\Dns\Txt\Requests\SearchRequest;

use DZResellerClub\Dns\Txt\Responses\AddResponse;
use DZResellerClub\Dns\Txt\Responses\SearchResponse;
use DZResellerClub\Dns\Txt\Responses\UpdateResponse;
use Symfony\Component\VarDumper\VarDumper;

class TxtRecord
{
    /**
     * @var Api
     */
    private $api;

    /**
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Add a new TXT record.
     *
     * @see https://manage.resellerclub.com/kb/node/1097
     *
     * @param AddRequest $request
     *
     * @return AddResponse
     */
    public function add(AddRequest $request): AddResponse
    {
        $response = $this->api->post(
            'dns/manage/add-txt-record.json',
            [
                'domain-name'       => (string) $request->domain(),
                'host'              => (string) $request->record(),
                'value'             => (string) $request->value(),
                'ttl'               => (int) $request->ttl()->integer(),
            ]
        );

        return AddResponse::fromApiResponse($response);
    }

    /**
     * Update an existing TXT record.
     *
     * @see https://manage.resellerclub.com/kb/node/1104
     *
     * @param UpdateRequest $request
     *
     * @return UpdateResponse
     */
    public function update(UpdateRequest $request): UpdateResponse
    {
        // HOST     TXT     VALUE      TTL
        $response = $this->api->post(
            'dns/manage/update-txt-record.json',
            [
                'domain-name'       => (string) $request->domain(),
                'host'              => (string) $request->record(), // The host part of the domain-name for which you need to modify a TXT record
                'current-value'     => (string) $request->currentValue(), // Current TXT value
                'new-value'         => (string) $request->newValue(), // Replace Current TXT with new value
                'ttl'               => (int) $request->ttl()->integer(), // TTL
            ]
        );

        return UpdateResponse::fromApiResponse($response);
    }

    /**
     * Update an existing TXT record.
     *
     * @see https://manage.resellerclub.com/kb/node/1106
     *
     * @param UpdateRequest $request
     *
     * @return UpdateResponse
     */
    public function search(SearchRequest $request): SearchResponse
    {
        $data = [
            'auth-userid' => 784909,
            'api-key' => 'GPFOx3p9Y7byCpiZwaP3vtV9QiMbV1c2',
            'domain-name'       => (string) $request->domain(),
            'type'              => 'TXT',
            'no-of-records'     => 1,
            'page-no'           => 0,
            'host'              => (string) $request->record(), // The host part of the domain-name for which you need to modify a TXT record
        ];

        if( strlen($request->value()) ) {
            $data = array_merge($data, [
                'value' => (string) $request->value(), // Current TXT value
            ]);
        }

        $response = $this->api->get(
            'dns/manage/search-records.xml',
            $data
        );

        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
        //    CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        // httpapi.com/api/dns/manage/search-records.json?auth-userid=0&api-key=key&domain-name=domain.asia&type=A&no-of-records=10&page-no=1
        $url = 'https://httpapi.com/api/dns/manage/search-records.json?' .
            'auth-userid=784909' .
            '&api-key=GPFOx3p9Y7byCpiZwaP3vtV9QiMbV1c2' .
            '&domain-name=' . $request->domain() .
            '&type=' . 'TXT'.
            '&no-of-records=1' .
            '&page-no=1' .
            '&host=' . $request->record() ;

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;

        VarDumper::dump($header);

        return SearchResponse::fromApiResponse($response);
    }
}
