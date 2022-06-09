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
     *
     * @param  \Illuminate\Auth\Events\Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        if (config('auth.single-device') && request()->has('password') && in_array('logoutOtaherDevices', get_class_methods(Auth::class))) {
            Auth::logoutOtaherDevices(request('password'));
        }
    }
}
