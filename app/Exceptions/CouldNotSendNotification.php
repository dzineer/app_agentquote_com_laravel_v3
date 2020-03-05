<?php

namespace App\Flowroute\Exceptions;

/**
 * Class CouldNotSendNotification
 * @package NotificationChannels\Flowroute\Exceptions
 */
class CouldNotSendNotification extends \Exception
{

    /**
     * @param $response mixed|\Psr\Http\Message\ResponseInterface
     * @return static
     */
    public static function serviceRespondedWithAnError($response)
    {
        $msg = 'Notification was not sent. Flowroute responded with ';

        if (empty($response)) {
            return new static($msg . "NULL");
        } else {
            return new static("$msg `{$response->getReasonPhrase()}: {$response->getBody()}`");
        }
    }
}
