<?php

namespace App\Actions\Builder\Menu;

use App\Contracts\Builder;
use App\Contracts\Menu;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class Sidebar implements Builder, Menu
{
    private Collection $menus;

    public function menus(): Collection
    {
        return $this->menus;
    }

    public function build(): self
    {
        $this->menus = collect([
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
                'icon' => 'o-home',
            ],
            [
                'show' => Gate::allows('viewAny', User::class),
                'route' => 'users.index',
                'label' => 'Users',
                'icon' => 'o-users',
            ],
        ])->reject(fn ($menu) => $menu['show'] == false);

        return $this;
    }
}
