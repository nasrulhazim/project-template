<?php

namespace App\Actions\Builder\Menu;

use App\Contracts\Builder;
use App\Contracts\Menu;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Jetstream;

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
                'url' => route('welcome'),
                'label' => 'Welcome',
            ],
            [
                'show' => auth()->user() ? false : Route::has('register'),
                'url' => route('register'),
                'label' => 'Register',
            ],
            [
                'show' => auth()->user() ? false : true,
                'url' => route('login'),
                'label' => 'Login',
            ],
            [
                'show' => auth()->user() ? true : false,
                'url' => route('dashboard'),
                'label' => 'Dashboard',
                'icon' => 'o-home',
            ],
            [
                'show' => Gate::allows('viewAny', User::class),
                'url' => route('users.index'),
                'label' => 'Users',
                'icon' => 'o-users',
            ],
            [
                'show' => Jetstream::hasApiFeatures(),
                'url' => route('api-tokens.index'),
                'label' => 'API Tokens',
                'icon' => 'o-clipboard-list',
            ],
            [
                'show' => auth()->user() && app()->environment() !== 'production',
                'url' => route('doc.db-schema'),
                'label' => 'Database Schema',
                'icon' => 'o-document',
            ],
        ])->reject(fn ($menu) => !$menu['show']);

        return $this;
    }
}
