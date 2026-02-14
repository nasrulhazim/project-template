<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Menu extends Component
{
    public Collection $menus;

    public string $view;

    public function mount(string $menu)
    {
        $this->view = $menu;
        $this->menus = menu($menu);
    }

    #[On('refresh-menu')]
    public function refreshMenu(): void
    {
        // No-op; triggers Livewire re-render
    }

    public function render(): View
    {
        return view('layouts.menu');
    }
}
