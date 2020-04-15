<?php

namespace DZResellerClub\Orders\Domains\Requests;

use DZResellerClub\Orders\Domains\DomainOrderDetailType;
use DZResellerClub\Orders\Order;

class GetByDomainRequest
{
    /**
     * The domain that the order is associated to.
     *
     * @var string
     */
    protected $domain;

    /**
     * Order detail level to be returned.
     *
     * @var DomainOrderDetailOption
     */
    private $domainOrderDetailOption;

    /**
     * Create a get request instance.
     *
     * @param string                $domain
     * @param DomainOrderDetailType $domainOrderDetailOption
     */
    public function __construct(string $domain, DomainOrderDetailType $domainOrderDetailOption)
    {
        $this->domain = $domain;
        $this->domainOrderDetailOption = $domainOrderDetailOption;
    }

    /**
     * Get the domain name of the order to be returned.
     *
     * @return string
     */
    public function domain(): string
    {
        return $this->domain;
    }

    /**
     * Get the order detail level to be returned.
     *
     * @return DomainOrderDetailType
     */
    public function orderDetailType(): DomainOrderDetailType
    {
        return $this->domainOrderDetailOption;
    }
}
