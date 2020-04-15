<?php

namespace Tests\Unit\Dns\A;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use DZResellerClub\Api;
use DZResellerClub\Config;
use DZResellerClub\Dns\A\ARecord;
use DZResellerClub\Dns\A\Requests\AddRequest;
use DZResellerClub\Dns\A\Requests\UpdateRequest;
use DZResellerClub\Dns\A\Responses\AddResponse;
use DZResellerClub\Dns\A\Responses\UpdateResponse;
use DZResellerClub\IPv4Address;
use DZResellerClub\TimeToLive;

class ARecordTest extends TestCase
{
    public function testAddInstance()
    {
        $ARecord = new ARecord($this->api($this->mockResponse()));

        $addRequest = new AddRequest(
            'mytestdomain.com',
            'www',
            new IPv4Address('127.0.0.1'),
            new TimeToLive(7200)
        );

        $this->assertInstanceOf(AddResponse::class, $ARecord->add($addRequest));
    }

    public function testUpdateInstance()
    {
        $ARecord = new ARecord($this->api($this->mockResponse()));

        $updateRequest = new UpdateRequest(
            'mytestdomain.com',
            'www',
            new IPv4Address('127.0.0.1'),
            new IPv4Address('192.168.0.1'),
            new TimeToLive(7200)
        );

        $this->assertInstanceOf(UpdateResponse::class, $ARecord->update($updateRequest));
    }

    private function api(MockHandler $mock): Api
    {
        $handler = HandlerStack::create($mock);

        return new Api(
            new Config(123, 'api_key', true),
            new Client(['handler' => $handler])
        );
    }

    /**
     * @return MockHandler
     */
    private function mockResponse(): MockHandler
    {
        return new MockHandler([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'response' => [
                        'status' => 'Success',
                    ],
                ])
            ),
        ]);
    }
}
