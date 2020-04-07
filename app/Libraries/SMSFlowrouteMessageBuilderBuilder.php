<?php


namespace App\Libraries;

use App\Contracts\FlowrouteMessageContract;


/**
 * Class SMSFlowrouteMessageBuilderBuilder
 * @package App\Libraries
 */
class SMSFlowrouteMessageBuilderBuilder implements SMSMessageBuilderInterface
{
    /**
     * @var FlowrouteMessageContract
     */
    private $contract;

    /**
     * SMSFlowrouteMessageBuilderBuilder constructor.
     * @param FlowrouteMessageContract $contract
     */
    public function __construct(FlowrouteMessageContract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * @return mixed
     */
    public function build() {

       return $this->contract->generate();

    }
}
