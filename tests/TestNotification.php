<?php

namespace VanDeWeijer\OneSignal\Test;

use Illuminate\Notifications\Notification;
use VanDeWeijer\OneSignal\OneSignalMessage;

class TestNotification extends Notification
{
    public function toOneSignal($notifiable)
    {
        return (new OneSignalMessage('Body'))
            ->subject('Subject')
            ->icon('Icon')
            ->url('URL');
    }
}
