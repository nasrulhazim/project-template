<?php

namespace App\Livewire\Administration;

use App\Models\Role;
use Livewire\Component;

class RolePermission extends Component
{
    public $role_id;

    public $permission_name;

    public $checked = false;

    public function mount($role_id, $permission_name, $checked = false)
    {
        $this->role_id = $role_id;
        $this->permission_name = $permission_name;
        $this->checked = $checked;
    }

    public function update()
    {
        $role = Role::whereId($this->role_id)->first();

        if ($role->hasPermissionTo($this->permission_name)) {
            $role->revokePermissionTo($this->permission_name);
        } else {
            $role->givePermissionTo($this->permission_name);
        }

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.administration.role-permission');
    }
}
