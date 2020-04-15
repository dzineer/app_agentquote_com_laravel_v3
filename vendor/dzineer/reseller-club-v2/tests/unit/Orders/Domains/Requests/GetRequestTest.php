<?php

namespace Tests\Unit\Orders\Domains\Requests;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Orders\Domains\DomainOrderDetailType;
use DZResellerClub\Orders\Domains\Requests\GetRequest;
use DZResellerClub\Orders\Order;

class GetRequestTest extends TestCase
{
    /**
     * @var DomainOrderDetailType
     */
    private $domainOrderDetailType;

    /**
     * @var GetRequest
     */
    private $request;

    protected function setUp()
    {
        parent::setUp();

        $this->domainOrderDetailType = DomainOrderDetailType::all();

        $this->request = new GetRequest(
            $order = new Order(123),
            $this->domainOrderDetailType
        );
    }

    public function testItCanGetOrderId()
    {
        $this->assertEquals(123, $this->request->orderId());
    }

    public function testItCanGetOrderDetailType()
    {
        $this->assertInstanceOf(DomainOrderDetailType::class, $this->request->orderDetailType());
        $this->assertEquals((string) $this->domainOrderDetailType, $this->request->orderDetailType());
    }
}
