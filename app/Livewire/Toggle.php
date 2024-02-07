<?php

namespace App\Livewire;

use Livewire\Component;

class Toggle extends Component
{
    public $enabled = false;

    public $enabled_field;

    public $key;

    public $field;

    public $value;

    private $class;

    private $classes = [
        'role' => \App\Models\Role::class,
        'user' => \App\Models\User::class,
    ];

    private function getClass($key)
    {
        throw_if(! isset($this->classes[$key]));

        return $this->classes[$key];
    }

    public function mount($enabled_field = 'is_enabled', $enabled = false)
    {
        $this->enabled = $enabled;
        $this->enabled_field = $enabled_field;
    }

    public function update($key, $value, $field)
    {
        if (class_exists($this->class = $this->getClass($key))) {
            $resource = $this->class::where($field, $value)->first();

            $this->authorize('update', $resource);

            $this->enabled = ! $this->enabled;
            $resource->update([$this->enabled_field => $this->enabled]);

            $this->dispatch('saved')->self();
        }
    }

    public function render()
    {
        return view('livewire.toggle');
    }
}
