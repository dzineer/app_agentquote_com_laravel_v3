<?php

namespace Tests\Unit\Orders\BusinessEmails\Requests;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Orders\BusinessEmails\Requests\RenewRequest;
use DZResellerClub\Orders\InvoiceOption;
use DZResellerClub\Orders\Order;

class RenewRequestTest extends TestCase
{
    /**
     * @var RenewRequest
     */
    private $request;

    protected function setUp()
    {
        parent::setUp();

        $order = new Order(123);

        $invoiceOption = InvoiceOption::noInvoice();

        $this->request = new RenewRequest(
            $order,
            $months = 3,
            $numberOfAccounts = 0,
            $invoiceOption
        );
    }

    public function testItCanGetOrderId()
    {
        $this->assertEquals(123, $this->request->orderId());
    }

    public function testItCanGetMonths()
    {
        $this->assertEquals(3, $this->request->months());
    }

    public function testItCanGetNumberOfAccounts()
    {
        $this->assertEquals(0, $this->request->numberOfAccounts());
    }

    public function testItCanGetInvoiceOption()
    {
        $this->assertInstanceOf(InvoiceOption::class, $this->request->invoiceOption());
        $this->assertEquals('NoInvoice', (string) $this->request->invoiceOption());
    }
}
