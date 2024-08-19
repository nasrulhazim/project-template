<?php

use App\Actions\Builder\Menu;

if (! function_exists('menu')) {
    function menu(string $builder)
    {
        return Menu::make()->build($builder)->menus();
    }
}
