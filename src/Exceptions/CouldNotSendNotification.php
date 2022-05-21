<?php

namespace VanDeWeijer\OneSignal\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('OneSignal responded with an error: `'.$response->getBody()->getContents().'`');
    }
}
