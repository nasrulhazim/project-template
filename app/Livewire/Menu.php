<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Menu extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-menu' => '$refresh',
    ];

    public Collection $menus;

    public string $view;

    public function mount(string $menu)
    {
        $this->view = $menu;
        $this->menus = menu($menu);
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('layouts.menu');
    }
}
