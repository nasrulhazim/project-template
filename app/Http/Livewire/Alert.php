<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Alert extends Component
{
    public $displayingModal = false;

    public $state = [
        'title' => '',
        'message' => '',
    ];

    protected $listeners = [
        'displayAlert' => 'display',
    ];

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
