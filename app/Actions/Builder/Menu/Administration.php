<?php

namespace App\Actions\Builder\Menu;

use App\Actions\Builder\MenuItem;
use CleaniqueCoders\Traitify\Contracts\Builder;
use CleaniqueCoders\Traitify\Contracts\Menu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class Administration implements Builder, Menu
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
                ->setLabel(__('Issues'))
                ->setUrl(url(config('telescope.path')))
                ->setTarget('_blank')
                ->setVisible(fn () => Gate::allows('viewTelescope'))
                ->setTooltip(__('View Telescope issues'))
                ->setDescription(__('Access application issues using Laravel Telescope'))
                ->setIcon('o-bug'), // Heroicon outline for a bug

            (new MenuItem)
                ->setLabel(__('Queues'))
                ->setUrl(url(config('horizon.path')))
                ->setTarget('_blank')
                ->setVisible(fn () => Gate::allows('viewHorizon'))
                ->setTooltip(__('Manage queues'))
                ->setDescription(__('Access Laravel Horizon to monitor and manage queues'))
                ->setIcon('o-cog'), // Heroicon outline for settings/tasks

            (new MenuItem)
                ->setLabel(__('Access Control'))
                ->setUrl(route('security.access-control.index'))
                ->setVisible(fn () => Gate::allows('viewAccessControl'))
                ->setTooltip(__('Manage access control'))
                ->setDescription(__('Define and manage access control rules'))
                ->setIcon('o-lock-closed'), // Heroicon outline for a lock

            (new MenuItem)
                ->setLabel(__('Users'))
                ->setUrl(route('security.users.index'))
                ->setVisible(fn () => Gate::allows('viewUser'))
                ->setTooltip(__('Manage users'))
                ->setDescription(__('View and manage user accounts'))
                ->setIcon('o-user-group'), // Heroicon outline for a group of users

            (new MenuItem)
                ->setLabel(__('Audit Trail'))
                ->setUrl(route('security.audit-trail.index'))
                ->setVisible(fn () => Gate::allows('viewAudit'))
                ->setTooltip(__('View audit trails'))
                ->setDescription(__('Audit logs for security and activity tracking'))
                ->setIcon('o-document-text'), // Heroicon outline for a document
        ])->reject(fn (MenuItem $menu) => ! $menu->isVisible())
            ->map(fn (MenuItem $menu) => $menu->build()->toArray());

        return $this;
    }
}
