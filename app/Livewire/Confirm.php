<?php

namespace App\Livewire;

use Livewire\Component;

class Confirm extends Component
{
    public $displayingModal = false;

    protected $listeners = [
        'displayConfirmation' => 'display',
    ];

    public $state = [
        'title' => '',
        'message' => '',
        'return' => [
            'component' => '',
            'args' => [],
        ],
    ];

    public function display($title, $message, $component, $listener, ...$params)
    {
        $this->state['title'] = $title;
        $this->state['message'] = $message;
        $this->state['return'] = [
            'component' => $component,
            'listener' => $listener,
            'params' => $params,
        ];

        $this->displayingModal = true;
    }

    public function confirm()
    {
        $this->dispatch(
            $this->state['return']['listener'],
            ...$this->state['return']['params'],
        )->to($this->state['return']['component']);

        $this->displayingModal = false;
    }

    public function cancel()
    {
        $this->state = [
            'title' => '',
            'message' => '',
            'return' => [
                'component' => '',
                'args' => [],
            ],
        ];
        $this->displayingModal = false;
    }

    public function render()
    {
        return view('livewire.confirm');
    }
}
