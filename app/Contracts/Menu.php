<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface Menu
{
    public function menus(): Collection;
}
