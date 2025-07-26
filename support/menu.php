<?php

use App\Actions\Builder\Menu;
use Illuminate\Support\Collection;

if (! function_exists('menu')) {
    /**
     * Menu helper to build menus based on type.
     *
     * @param string $builder See app/Actions/Builder/Menu.php for the available menue.
     * @return \Illuminate\Support\Collection<int, \App\Actions\Builder\MenuItem>
     */
    function menu(string $builder): Collection
    {
        return Menu::make()->build($builder)->menus();
    }
}
