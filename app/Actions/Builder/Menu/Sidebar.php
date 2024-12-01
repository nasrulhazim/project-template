<?php

namespace App\Actions\Builder\Menu;

use App\Actions\Builder\MenuItem;
use CleaniqueCoders\Traitify\Contracts\Builder;
use CleaniqueCoders\Traitify\Contracts\Menu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Laravel\Jetstream\Jetstream;

class Sidebar implements Builder, Menu
{
    private Collection $menus;

    /**
     * Return the list of menus.
     */
    public function menus(): Collection
    {
        return $this->menus;
    }

    /**
     * Build the administration menu items.
     */
    public function build(): self
    {
        $this->menus = collect([
            (new MenuItem)
                ->setLabel(__('Profile'))
                ->setUrl(route('profile.show'))
                ->setTooltip(__('Manage your profile settings'))
                ->setIcon('o-user')
                ->setDescription(__('Access and manage your account settings.')),

            (new MenuItem)
                ->setLabel(__('API Tokens'))
                ->setUrl(route('api-tokens.index'))
                ->setVisible(fn () => Jetstream::hasApiFeatures())
                ->setTooltip(__('Manage API Tokens'))
                ->setIcon('o-key')
                ->setDescription(__('Create and manage API tokens for external services.')),

            (new MenuItem)
                ->setLabel(__('Administration'))
                ->setUrl(route('administration.index'))
                ->setVisible(fn () => Gate::allows('viewAdmin'))
                ->setTooltip(__('Administration Panel'))
                ->setIcon('o-computer-desktop')
                ->setDescription(__('Access administrative tools and settings.')),

            (new MenuItem)
                ->setLabel(__('Logout'))
                ->setUrl(route('logout'))
                ->setTooltip(__('Sign out of your account'))
                ->setIcon('o-logout')
                ->setDescription(__('Securely log out of your account.'))
                ->setTarget('_self')
                ->setType('form')
                ->setFormAttributes([
                    'method' => 'POST',
                    'csrf' => true,
                ]),
        ])
            ->reject(fn (MenuItem $menu) => ! $menu->isVisible())
            ->map(fn (MenuItem $menu) => $menu->build()->toArray());

        return $this;
    }
}
