<?php

namespace DZResellerClub\Dns\Txt;

use DZResellerClub\Api;

use DZResellerClub\Dns\Txt\Requests\AddRequest;
use DZResellerClub\Dns\Txt\Requests\UpdateRequest;
use DZResellerClub\Dns\Txt\Requests\SearchRequest;

use DZResellerClub\Dns\Txt\Responses\AddResponse;
use DZResellerClub\Dns\Txt\Responses\UpdateResponse;

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
            'domain-name'       => (string) $request->domain(),
            'type'              => 'TXT',
            'no-of-records'     => 10,
            'page-no'           => 1,
            'host'              => (string) $request->record(), // The host part of the domain-name for which you need to modify a TXT record
        ];

        if( strlen($request->value()) ) {
            $data = array_merge($data, [
                'value' => (string) $request->value(), // Current TXT value
            ]);
        }

        $response = $this->api->get(
            'dns/manage/search-records.json',
            $data
        );

        return SearchResponse::fromApiResponse($response);
    }
}
