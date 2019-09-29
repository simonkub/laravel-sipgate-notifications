<?php

namespace Simonkub\Laravel\Notifications\Sipgate\Exceptions;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class CouldNotSendNotification extends Exception
{
    const NO_RECIPIENT = 'Could not find recipient for notification';
    const NO_SMS_ID = 'Could not find SmsId';
    const CONNECTION_FAILED = "Could not connect to sipgate: %s: %s";

    public static function noRecipient()
    {
        return new static(self::NO_RECIPIENT);
    }

    public static function noSmsId()
    {
        return new static(self::NO_SMS_ID);
    }

    public static function connectionFailed(GuzzleException $exception)
    {
        return new static(
            sprintf(self::CONNECTION_FAILED, $exception->getCode(), $exception->getMessage())
        );
    }
}
