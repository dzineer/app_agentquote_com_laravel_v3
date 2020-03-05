<?php

use Mockery as m;
use Dzineer\SMS\Drivers\SMS77;
use Dzineer\SMS\OutgoingMessage;

class SMS77Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Dzineer\SMS\SMS
     */
    protected $sms;

    public function setUp()
    {
        parent::setUp();
        $username = getenv('SMS77USER');
        if (! $username) {
            $this->markTestSkipped('SMS77 integration Testing not possible with out SMS77 user name (SMS77USER + SMS77PASSWORD in ENV). Skipping.');
        }
        $password = getenv('SMS77PASSWORD');
        $debug = getenv('SMS77DEBUG', 1);
        $this->driver = new SMS77(new GuzzleHttp\Client(), $username, $password, $debug);
        $this->sms = new \Dzineer\SMS\SMS($this->driver);
    }

    public function testSendSMS()
    {
        $viewFactory = m::mock('\Illuminate\View\Factory');
        $view = m::mock('\Illuminate\View\View');
        $viewFactory->shouldReceive('make')->andReturn($view);
        $view->shouldReceive('render')->andReturn('Hello world');

        $message = new OutgoingMessage($viewFactory);
        $message->view($viewFactory);
        $message->data([]);
        $message->to('+155555555');
        $this->driver->send($message);
    }

    public function testSendSMSReal()
    {
        $this->markTestSkipped('Not sending real SMS - comment this line to try');
    }
}
