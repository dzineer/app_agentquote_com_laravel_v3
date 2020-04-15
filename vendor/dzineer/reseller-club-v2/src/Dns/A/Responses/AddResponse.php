<?php

namespace DZResellerClub\Dns\A\Responses;

use DZResellerClub\Message;
use DZResellerClub\Response;

class AddResponse extends Response
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