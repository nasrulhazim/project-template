<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar', ['menus' => $this->build()]);
    }

    private function build(): array
    {
        return collect([
            [
                'label' => __('Settings'),
                'display' => true,
                'icon' => 'o-user',
                'url' => '#',
                'child' => [
                    [
                        'label' => __('Users'),
                        'display' => auth()->user()->can('manage-users'),
                        'icon' => 'o-user',
                        'url' => route('users.index'),
                    ],
                ],
            ],
            [
                'label' => __('Users'),
                'display' => auth()->user()->can('manage-users'),
                'icon' => 'o-user',
                'url' => route('users.index'),
            ],
        ])->reject(function ($menu) {
            return $menu['display'] == false;
        })->toArray();
    }
}
