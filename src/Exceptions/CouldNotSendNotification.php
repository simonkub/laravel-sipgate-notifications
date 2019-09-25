<?php

namespace SimonKub\Laravel\Notifications\Sipgate\Exceptions;

use Exception;
use Throwable;

class CouldNotSendNotification extends Exception
{
    public static function noRecipient()
    {
        return new static('Could not find recipient for notification');
    }

    public static function noSmsId()
    {
        return new static('Could not find SmsId');
    }

    public static function connectionFailed(Throwable $exception)
    {
        return new static(
            "Could not connect to sipgate: {$exception->getCode()}: {$exception->getMessage()}"
        );
    }
}
