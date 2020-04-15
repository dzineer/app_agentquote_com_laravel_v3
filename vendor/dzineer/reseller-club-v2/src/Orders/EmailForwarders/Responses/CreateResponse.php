<?php

namespace DZResellerClub\Orders\EmailForwarders\Responses;

use DZResellerClub\Response;
use DZResellerClub\Status;

class CreateResponse extends Response
{
    /**
     * Get the response status.
     *
     * @return Status
     */
    public function status(): Status
    {
        return new Status($this->response['status']);
    }
}
