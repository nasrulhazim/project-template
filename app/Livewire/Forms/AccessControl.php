<?php

namespace App\Livewire\Forms;

use App\Actions\Forms\CreateNewRole as Action;
use App\Concerns\InteractsWithLivewireForm;
use App\Models\Role as Model;
use Livewire\Attributes\On;
use Livewire\Component;

class AccessControl extends Component
{
    use InteractsWithLivewireForm;

    public string $model = Model::class;

    public string $action = Action::class;

    public string $formTitle = 'Access Control';

    public string $view = 'livewire.forms.access-control';

    public $state = [
        'name' => '',
        'display_name' => '',
        'guard_name' => 'web',
        'description' => '',
    ];

    public $displayCreateRecord = true;

    public $reloadPageOnSave = true;

    public function beforeSave()
    {
        $this->state['name'] = str($this->state['display_name'])->lower()->kebab()->toString();
    }

    public function mount($displayCreateRecord = true)
    {
        $this->displayCreateRecord = $displayCreateRecord;
    }

    public function close()
    {
        $this->edit = $this->displayCreateRecord == false;
        $this->displayingModal = false;
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
