<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Message;

class MessageTest extends TestCase
{
    public function testMessageReturnsCorrectString()
    {
        $this->assertEquals('This is the message', (string) new Message('This is the message'));
    }
}
