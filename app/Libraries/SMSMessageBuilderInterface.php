<?php


namespace App\Libraries;


use App\Contracts\FlowrouteMessageContract;

/**
 * Interface SMSMessageBuilderInterface
 * @package App\Libraries
 */
interface SMSMessageBuilderInterface
{
    /**
     * SMSMessageBuilderInterface constructor.
     * @param FlowrouteMessageContract $contract
     */
    function __construct(FlowrouteMessageContract $contract);

    /**
     * @return mixed
     */
    function build();
}
