<?php

namespace VanDeWeijer\OneSignal\Test;

class Notifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return int
     */
    public function routeNotificationForOneSignal()
    {
        return 'player_id';
    }
}
