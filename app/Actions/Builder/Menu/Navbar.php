<?php

namespace App\Actions\Builder\Menu;

use App\Models\User;
use CleaniqueCoders\Traitify\Contracts\Builder;
use CleaniqueCoders\Traitify\Contracts\Menu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class Navbar implements Builder, Menu
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
                'url' => route('welcome'),
                'label' => __('Welcome'),
            ],
            [
                'show' => auth()->user() ? false : Route::has('register'),
                'url' => route('register'),
                'label' => __('Register'),
            ],
            [
                'show' => auth()->user() ? false : true,
                'url' => route('login'),
                'label' => __('Login'),
            ],
            [
                'show' => auth()->user() ? true : false,
                'url' => route('dashboard'),
                'label' => __('Dashboard'),
            ],
            [
                'show' => Gate::allows('viewAny', User::class),
                'url' => route('users.index'),
                'label' => __('Users'),
            ],
        ])->reject(fn ($menu) => $menu['show'] == false);

        return $this;
    }
}
