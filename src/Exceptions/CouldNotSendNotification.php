<?php

namespace NotificationChannels\Sipgate\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('Descriptive error message.');
    }
}
