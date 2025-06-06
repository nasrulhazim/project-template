<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Auth;

class LogoutFromOtherDevices
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Authenticated $event): void
    {
        if (config('auth.single-device') && request()->has('password') && in_array('logoutOtherDevices', get_class_methods(Auth::class))) {
            Auth::logoutOtherDevices(request('password'));
        }
    }
}
