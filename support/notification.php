<?php

use App\Notifications\DefaultNotification;

if (! function_exists('notification_drivers')) {
    /**
     * Get Default Notification Drivers.
     */
    function notification_drivers()
    {
        return config('notification.default');
    }
}

if (! function_exists('notification_enabled')) {
    /**
     * Get Notification Enable Status.
     */
    function notification_enabled()
    {
        return config('notification.enabled');
    }
}

if (! function_exists('notify')) {
    function notify(App\Models\User $user, $subject, $message, $url = null)
    {
        $user->notify(
            (new DefaultNotification($subject, $message, $url))
                ->onQueue('notification')
        );
    }
}
