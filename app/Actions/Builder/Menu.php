<?php

namespace App\Actions\Builder;

use App\Actions\Builder\Menu\Navbar;
use App\Actions\Builder\Menu\Sidebar;
use App\Exceptions\ContractException;
use CleaniqueCoders\Traitify\Contracts\Builder;
use CleaniqueCoders\Traitify\Contracts\Menu as ContractsMenu;

class Menu
{
    public static function make()
    {
        return new self;
    }

    public function build(string $builder): Builder|ContractsMenu
    {
        $class = match ($builder) {
            'navbar' => Navbar::class,
            'sidebar' => Sidebar::class,
            default => Navbar::class,
        };

        /**
         * @var \CleaniqueCoders\Traitify\Contracts\Builder|\CleaniqueCoders\Traitify\Contracts\Menu
         */
        $builder = new $class;

        ContractException::throwUnless(! $builder instanceof Builder, 'missingContract', $class, Builder::class);
        ContractException::throwUnless(! $builder instanceof ContractsMenu, 'missingContract', $class, Builder::class);

        return $builder->build();
    }
}
