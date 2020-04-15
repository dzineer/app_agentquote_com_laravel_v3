<?php

namespace Tests\Unit\Orders\EmailForwarders\Responses;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Orders\EmailForwarders\Responses\CreateResponse;
use DZResellerClub\Status;

class CreateResponseTest extends TestCase
{
    /**
     * @var CreateResponse
     */
    private $response;

    protected function setUp()
    {
        parent::setUp();

        $this->response = new CreateResponse([
            'response' => [
                'status' => 'SUCCESS',
            ],
        ]);
    }

    public function testItCanGetStatus()
    {
        $this->assertInstanceOf(Status::class, $this->response->status());
        $this->assertEquals('success', (string) $this->response->status());
    }

    public function testItIsSuccessfulIfStatusIsSuccess()
    {
        $this->assertTrue($this->response->wasSuccessful());
    }
}
