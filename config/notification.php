<?php

return [
    /*
     * By default notificatio is disabled
     */
    'enabled' => env('NOTIFICATION_ENABLED', true),

    /*
     * Default notification drivers.
     *
     * Possible setup in .env:
     * DEFAULT_NOTIFICATION_DRIVERS=database,mail,nexmo,sms
     */
    'default' => explode(',', env('NOTIFICATION_DEFAULT_DRIVERS', 'database')),
];
