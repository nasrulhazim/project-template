<?php

namespace App\Livewire\Security;

use App\Models\User;
use Livewire\Component;

class ToggleUserRole extends Component
{
    public $enabled = false;

    public $role;

    public $key = 'user';

    public $value;

    public $field = 'uuid';

    public function mount($uuid, $role)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $this->value = $uuid;
        $this->role = $role;
        $this->enabled = $user->hasRole($role);
    }

    public function update($key, $value, $field)
    {
        $user = User::where($field, $value)->first();

        if ($this->enabled) {
            $user->removeRole($this->role);
        } else {
            $user->assignRole($this->role);
        }

        $this->dispatch('saved');

        $this->enabled = ! $this->enabled;
    }

    public function render()
    {
        return view('livewire.toggle');
    }
}
