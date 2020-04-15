<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Status;

class StatusTest extends TestCase
{
    public function testStatus()
    {
        $this->assertEquals('success', (string) new Status('Success'));
        $this->assertEquals('success', (string) new Status('SUCCESS'));
        $this->assertEquals('success', (string) new Status('success'));
    }
}
