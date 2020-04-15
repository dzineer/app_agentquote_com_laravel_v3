<?php

namespace Tests\Unit\Dns\Cname;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use DZResellerClub\Api;
use DZResellerClub\Config;
use DZResellerClub\Dns\Cname\CnameRecord;
use DZResellerClub\Dns\Cname\Requests\AddRequest;
use DZResellerClub\Dns\Cname\Requests\UpdateRequest;
use DZResellerClub\Dns\Cname\Responses\AddResponse;
use DZResellerClub\Dns\Cname\Responses\UpdateResponse;
use DZResellerClub\TimeToLive;

class CnameRecordTest extends TestCase
{
    public function testAddInstance()
    {
        $cnameRecord = new CnameRecord($this->api($this->mockResponse()));

        $addRequest = new AddRequest(
            'mytestdomain.com',
            'www',
            'cname.new.com',
            new TimeToLive(7200)
        );

        $this->assertInstanceOf(AddResponse::class, $cnameRecord->add($addRequest));
    }

    public function testUpdateInstance()
    {
        $cnameRecord = new CnameRecord($this->api($this->mockResponse()));

        $updateRequest = new UpdateRequest(
            'mytestdomain.com',
            'www',
            'cname.old.com',
            'cname.new.com',
            new TimeToLive(7200)
        );

        $this->assertInstanceOf(UpdateResponse::class, $cnameRecord->update($updateRequest));
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
