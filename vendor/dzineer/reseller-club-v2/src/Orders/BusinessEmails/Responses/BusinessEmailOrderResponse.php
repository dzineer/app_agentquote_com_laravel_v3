<?php

namespace DZResellerClub\Orders\BusinessEmails\Responses;

use DZResellerClub\Orders\BusinessEmails\Responses\Concerns\HasAction;
use DZResellerClub\Response;

class BusinessEmailOrderResponse extends Response
{
    use HasAction;

    /**
     * Get the domain parameter.
     *
     * @return string
     */
    public function domain(): string
    {
        return $this->description;
    }

    /**
     * Get the order ID parameter.
     *
     * @return int
     */
    public function orderId(): int
    {
        return $this->entityid;
    }
}
