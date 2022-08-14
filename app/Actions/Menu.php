<?php

namespace App\Actions;

use App\Actions\Builder\Menu\Navbar;
use App\Actions\Builder\Menu\Sidebar;
use App\Contracts\Builder;
use App\Contracts\Menu as ContractsMenu;
use App\Exceptions\ContractException;

class Menu
{
    public static function make()
    {
        return new self();
    }

    public function build(string $builder): Builder|ContractsMenu
    {
        $class = match ($builder) {
            'navbar' => Navbar::class,
            'sidebar' => Sidebar::class,
            default => Navbar::class,
        };

        /**
         * @var \App\Contracts\Builder|\App\Contracts\Menu
         */
        $builder = new $class();

        ContractException::throwUnless(! $builder instanceof Builder, 'missingContract', $class, Builder::class);
        ContractException::throwUnless(! $builder instanceof ContractsMenu, 'missingContract', $class, Builder::class);

        return $builder->build();
    }
}
