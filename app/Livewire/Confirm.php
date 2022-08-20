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

    public function display($title, $message, $component, ...$args)
    {
        $this->state['title'] = $title;
        $this->state['message'] = $message;
        $this->state['return'] = [
            'component' => $component,
            'args' => $args,
        ];

        $this->displayingModal = true;
    }

    public function confirm()
    {
        $this->emitTo(
            $this->state['return']['component'],
            ...$this->state['return']['args']
        );

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
