<?php

namespace App\Livewire\Forms;

use App\Actions\User\CreateNewUser;
use App\Concerns\InteractsWithLivewireForm;
use App\Models\Role;
use App\Models\User as Model;
use Livewire\Component;

class User extends Component
{
    use InteractsWithLivewireForm;

    public string $model = Model::class;

    public string $action = CreateNewUser::class;

    public string $formTitle = 'User';

    public string $view = 'livewire.forms.user';

    protected $listeners = [
        'showRecord' => 'show',
        'destroyRecord' => 'destroy',
    ];

    protected array $uuid2id = [];

    protected array $hashFields = [
        'password',
    ];

    public $state = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public array $roles = [];

    public function mount()
    {
        $this->roles = Role::all()->pluck('name', 'name')->map(fn ($value) => ucfirst($value))->toArray();
    }
}
