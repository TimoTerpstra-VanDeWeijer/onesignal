<?php

namespace VanDeWeijer\OneSignal\Test;

class NotifiableEmail
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return ['email' => 'test@example.com'];
    }
}
