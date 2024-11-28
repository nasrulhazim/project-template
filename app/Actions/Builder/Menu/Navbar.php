<?php

namespace App\Actions\Builder\Menu;

use App\Actions\Builder\MenuItem;
use App\Models\User;
use CleaniqueCoders\Traitify\Contracts\Builder;
use CleaniqueCoders\Traitify\Contracts\Menu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class Navbar implements Builder, Menu
{
    private Collection $menus;

    /**
     * Return the menus collection.
     */
    public function menus(): Collection
    {
        return $this->menus;
    }

    /**
     * Build the navbar menu items.
     */
    public function build(): self
    {
        $this->menus = collect([
            (new MenuItem)
                ->setLabel(__('Welcome'))
                ->setUrl(route('welcome'))
                ->setVisible(fn () => ! auth()->check()),

            (new MenuItem)
                ->setLabel(__('Register'))
                ->setUrl(route('register'))
                ->setVisible(fn () => ! auth()->check() && Route::has('register')),

            (new MenuItem)
                ->setLabel(__('Login'))
                ->setUrl(route('login'))
                ->setVisible(fn () => ! auth()->check()),

            (new MenuItem)
                ->setLabel(__('Dashboard'))
                ->setUrl(route('dashboard'))
                ->setVisible(fn () => auth()->check()),

            (new MenuItem)
                ->setLabel(__('Users'))
                ->setUrl(route('users.index'))
                ->setVisible(fn () => Gate::allows('viewAny', User::class)),
        ])
            ->reject(fn (MenuItem $menu) => ! $menu->isVisible())
            ->map(fn (MenuItem $menu) => $menu->build()->toArray());

        return $this;
    }
}
