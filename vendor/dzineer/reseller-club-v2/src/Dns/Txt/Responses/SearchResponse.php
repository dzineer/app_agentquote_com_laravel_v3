<?php

namespace DZResellerClub\Dns\Txt\Responses;

use DZResellerClub\Message;
use DZResellerClub\Response;

class SearchResponse extends Response
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
