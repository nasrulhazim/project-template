<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public $displayingModal = false;

    public $state = [
        'title' => '',
        'message' => '',
    ];

    #[On('displayAlert')]
    public function display($title, $message)
    {
        $this->state['title'] = $title;
        $this->state['message'] = $message;

        $this->displayingModal = true;
    }

    public function render()
    {
        return view('livewire.alert');
    }
}
