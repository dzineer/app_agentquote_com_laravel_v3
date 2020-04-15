<?php

namespace Tests\Unit\Orders\BusinessEmails\Responses;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Action;
use DZResellerClub\Orders\BusinessEmails\Responses\AddedEmailAccountResponse;
use DZResellerClub\Status;

class DeletedEmailAccountResponseTest extends TestCase
{
    /**
     * @var RenewalResponse
     */
    private $response;

    protected function setUp()
    {
        parent::setUp();

        $this->response = new AddedEmailAccountResponse([
            'entityid'          => '80239999',
            'description'       => 'test-domain-3.co.uk.onlyfordemo.com',
            'actionstatus'      => 'ExecutionStarted',
            'actionstatusdesc'  => 'Your email account deletion request will be processed shortly.',
            'actiontypedesc'    => 'Deletion of 1 email accounts for test-domain-3.co.uk.onlyfordemo.com',
            'status'            => 'Success',
            'eaqid'             => '471836050',
            'actiontype'        => 'DeleteEmailAccount',
        ]);
    }

    public function testItCanGetAction()
    {
        $this->assertInstanceOf(Action::class, $this->response->action());
        $this->assertEquals(471836050, $this->response->action()->id());
        $this->assertEquals('DeleteEmailAccount', $this->response->action()->type());
        $this->assertEquals(
            'Deletion of 1 email accounts for test-domain-3.co.uk.onlyfordemo.com',
            $this->response->action()->typeDescription()
        );
        $this->assertEquals(
            'ExecutionStarted',
            $this->response->action()->status()
        );
        $this->assertEquals(
            'Your email account deletion request will be processed shortly.',
            $this->response->action()->statusDescription()
        );
    }

    public function testItCanGetEntityId()
    {
        $this->assertEquals(80239999, $this->response->entityId());
    }

    public function testItCanGetDomain()
    {
        $this->assertEquals('test-domain-3.co.uk.onlyfordemo.com', $this->response->domain());
    }

    public function testItCanGetStatus()
    {
        $this->assertInstanceOf(Status::class, $this->response->status());
        $this->assertEquals('success', (string) $this->response->status());
    }
}
