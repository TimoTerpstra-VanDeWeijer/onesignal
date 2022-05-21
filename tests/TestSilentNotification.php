<?php

namespace VanDeWeijer\OneSignal\Test;

use Illuminate\Notifications\Notification;
use VanDeWeijer\OneSignal\OneSignalMessage;

class TestSilentNotification extends Notification
{
    public function toOneSignal($notifiable)
    {
        return (new OneSignalMessage())
            ->setSilent()
            ->setData('action', 'reload')
            ->setData('target', 'inbox');
    }
}
