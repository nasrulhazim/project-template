<?php

namespace App\Actions\Builder\Menu;

use App\Actions\Builder\MenuItem;
use App\Models\User;
use CleaniqueCoders\Traitify\Contracts\Builder;
use CleaniqueCoders\Traitify\Contracts\Menu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Jetstream;

class Sidebar implements Builder, Menu
{
    private Collection $menus;

    /**
     * Get the sidebar menus.
     */
    public function menus(): Collection
    {
        return $this->menus;
    }

    /**
     * Build the sidebar menu items.
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
                ->setIcon('o-home')
                ->setVisible(fn () => auth()->check()),

            (new MenuItem)
                ->setLabel(__('Users'))
                ->setUrl(route('users.index'))
                ->setIcon('o-users')
                ->setVisible(fn () => Gate::allows('viewAny', User::class)),

            (new MenuItem)
                ->setLabel(__('API Tokens'))
                ->setUrl(route('api-tokens.index'))
                ->setIcon('o-clipboard-list')
                ->setVisible(fn () => Jetstream::hasApiFeatures()),

            (new MenuItem)
                ->setLabel(__('Database Schema'))
                ->setUrl(route('doc.db-schema'))
                ->setIcon('o-document')
                ->setVisible(fn () => auth()->check() && app()->environment() !== 'production'),
        ])->reject(fn (MenuItem $menu) => ! $menu->isVisible())
            ->map(fn (MenuItem $menu) => $menu->build()->toArray());

        return $this;
    }
}
