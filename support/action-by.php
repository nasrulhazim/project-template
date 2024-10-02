<?php

if (! function_exists('get_action_by_user')) {
    function get_action_by_user()
    {
        if (app()->runningInConsole()) {
            return [
                'name' => 'Console',
                'timestamp' => now()->format('Y-m-d H:i:s'),
            ];
        }

        if (! auth()->user()) {
            return [
                'name' => 'Guest',
                'timestamp' => now()->format('Y-m-d H:i:s'),
            ];
        }

        return [
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'id' => auth()->user()->id,
        ];
    }
}
