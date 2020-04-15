<?php

namespace DZResellerClub\Dns\Cname\Responses;

use DZResellerClub\Message;
use DZResellerClub\Response;

class UpdateResponse extends Response
{
    /**
     * Get the response message.
     *
     * @return Message
     */
    public function message(): Message
    {
        return new Message($this->attributes['msg']);
    }
}
