<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    public string $keyword;

    public function mount(string $keyword = '')
    {
        $this->keyword = $keyword;
    }

    public function render()
    {
        return view('components.search');
    }

    public function search()
    {
        // do searching...then display
    }
}
