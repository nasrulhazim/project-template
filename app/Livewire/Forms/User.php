<?php

namespace App\Livewire\Forms;

use App\Actions\User\CreateNewUser;
use App\Concerns\InteractsWithLivewireForm;
use App\Models\Role;
use App\Models\User as Model;
use Livewire\Attributes\On;
use Livewire\Component;

class User extends Component
{
    use InteractsWithLivewireForm;

    public string $model = Model::class;

    public string $action = CreateNewUser::class;

    public string $formTitle = 'User';

    public string $view = 'livewire.forms.user';

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

    #[On('showRecord')]
    public function show(string $uuid, bool $edit = false): void
    {
        parent::show($uuid, $edit);
    }

    #[On('destroyRecord')]
    public function destroy(string $uuid): void
    {
        parent::destroy($uuid);
    }
}
