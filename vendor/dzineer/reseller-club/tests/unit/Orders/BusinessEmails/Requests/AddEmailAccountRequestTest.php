<?php

namespace Tests\Unit\Orders\BusinessEmails\Requests;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Orders\BusinessEmails\Requests\AddEmailAccountRequest;
use DZResellerClub\Orders\InvoiceOption;
use DZResellerClub\Orders\Order;

class AddEmailAccountRequestTest extends TestCase
{
    /**
     * @var AddEmailAccountRequest
     */
    private $request;

    protected function setUp()
    {
        parent::setUp();

        $order = new Order(123);

        $invoiceOption = InvoiceOption::noInvoice();

        $this->request = new AddEmailAccountRequest(
            $order,
            $numberOfAccounts = 1,
            $invoiceOption
        );
    }

    public function testItCanGetOrderId()
    {
        $this->assertEquals(123, $this->request->orderId());
    }

    public function testItCanGetNumberOfAccounts()
    {
        $this->assertEquals(1, $this->request->numberOfAccounts());
    }

    public function testItCanGetInvoiceOption()
    {
        $this->assertInstanceOf(InvoiceOption::class, $this->request->invoiceOption());
        $this->assertEquals('NoInvoice', (string) $this->request->invoiceOption());
    }
}
