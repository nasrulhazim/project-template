<?php

use App\Notifications\DefaultNotification;

if (! function_exists('notification_drivers')) {
    /**
     * Get Default Notification Drivers.
     *
     * @return array<string>
     */
    function notification_drivers(): array
    {
        return config('notification.default');
    }
}

if (! function_exists('notification_enabled')) {
    /**
     * Get Notification Enable Status.
     *
     * @return bool
     */
    function notification_enabled(): bool
    {
        return config('notification.enabled');
    }
}

if (! function_exists('notify')) {
    /**
     * Notify to targeted user with simple message.
     *
     * @param \App\Models\User $user
     * @param string $subject
     * @param string $message
     * @param string|null $url
     * @return void
     */
    function notify(App\Models\User $user, string $subject, string $message, ?string $url = null): void
    {
        $user->notify(
            (new DefaultNotification($subject, $message, $url))
                ->onQueue('notification')
        );
    }
}
