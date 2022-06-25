<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class Menu
{
    public static function build()
    {
        return collect([
            [
                'show' => auth()->user() ? false : true,
                'route' => 'welcome',
                'label' => 'Welcome',
            ],
            [
                'show' => auth()->user() ? false : Route::has('register'),
                'route' => 'register',
                'label' => 'Register',
            ],
            [
                'show' => auth()->user() ? false : true,
                'route' => 'login',
                'label' => 'Login',
            ],
            [
                'show' => auth()->user() ? true : false,
                'route' => 'dashboard',
                'label' => 'Dashboard',
            ],
            [
                'show' => Gate::allows('viewAny', User::class),
                'route' => 'users.index',
                'label' => 'Users',
            ],
        ])->reject(fn ($menu) => $menu['show'] == false);
    }
}
