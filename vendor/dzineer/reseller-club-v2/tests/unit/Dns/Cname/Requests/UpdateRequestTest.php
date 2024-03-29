<?php

namespace Tests\Unit\Dns\Cname\Requests;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Dns\Cname\Requests\UpdateRequest;
use DZResellerClub\TimeToLive;

class UpdateRequestTest extends TestCase
{
    public function testInstantiation()
    {
        $ttl = TimeToLive::defaultTtl();
        $request = new UpdateRequest(
            'test.com',
            'www',
            'cname.old.com',
            'cname.new.com',
            $ttl
        );

        $this->assertInstanceOf(UpdateRequest::class, $request);
    }

    public function testInstantiationWithoutTTL()
    {
        $request = new UpdateRequest(
            'test.com',
            'www',
            'cname.old.com',
            'cname.new.com'
        );

        $this->assertInstanceOf(UpdateRequest::class, $request);
    }

    public function testGetters()
    {
        $ttl = TimeToLive::defaultTtl();
        $request = new UpdateRequest(
            'test.com',
            'www',
            'cname.old.com',
            'cname.new.com',
            $ttl
        );

        $this->assertInternalType('string', $request->domain());
        $this->assertInternalType('string', $request->record());
        $this->assertInternalType('string', $request->currentValue());
        $this->assertInternalType('string', $request->newValue());
        $this->assertInstanceOf(TimeToLive::class, $request->ttl());
    }

    public function testGettersWithoutTTL()
    {
        $request = new UpdateRequest(
            'test.com',
            'www',
            'cname.old.com',
            'cname.new.com'
        );

        $this->assertInternalType('string', $request->domain());
        $this->assertInternalType('string', $request->record());
        $this->assertInternalType('string', $request->currentValue());
        $this->assertInternalType('string', $request->newValue());
        $this->assertInstanceOf(TimeToLive::class, $request->ttl());
        $this->assertEquals((string) $request->ttl(), TimeToLive::DEFAULT_TTL);
    }
}
