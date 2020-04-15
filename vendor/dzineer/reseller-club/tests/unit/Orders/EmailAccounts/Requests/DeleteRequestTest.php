<?php

namespace Tests\Unit\Orders\EmailAccounts\Requests;

use PHPUnit\Framework\TestCase;
use DZResellerClub\EmailAddress;
use DZResellerClub\Orders\EmailAccounts\Requests\DeleteRequest;
use DZResellerClub\Orders\Order;

class DeleteRequestTest extends TestCase
{
    /**
     * @var DeleteRequest
     */
    private $request;

    protected function setUp()
    {
        parent::setUp();

        $order = new Order(123);

        $this->request = new DeleteRequest(
            $order,
            new EmailAddress($email = 'john.doe@my-domain.co.uk')
        );
    }

    public function testOrderId()
    {
        $this->assertEquals(123, $this->request->orderId());
    }

    public function testEmail()
    {
        $this->assertEquals('john.doe@my-domain.co.uk', $this->request->email());
    }
}
