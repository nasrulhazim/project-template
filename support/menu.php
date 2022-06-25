<?php

use App\Actions\Menu;

if (! function_exists('menu')) {
    function menu()
    {
        return Menu::build();
    }
}
