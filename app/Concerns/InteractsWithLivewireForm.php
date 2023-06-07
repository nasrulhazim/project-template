<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

trait InteractsWithLivewireForm
{
    public string $uuid = '';

    public bool $edit = false;

    public $displayingModal = false;

    protected $default_state = [];

    protected $record;

    public function mount()
    {
        $this->setDefaultState();
    }

    public function resetState()
    {
        $this->state = $this->getDefaultState();
    }

    public function getDefaultState(): array
    {
        return $this->default_state;
    }

    public function setDefaultState(): self
    {
        $this->default_state = property_exists($this, 'state') ? $this->state : [];

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function hasUuid2idMapping()
    {
        return property_exists($this, 'uuid2id') && count($this->uuid2id) > 0;
    }

    public function getUuid2IdMapping(): array
    {
        return $this->uuid2id;
    }

    public function hasHashFieldsMapping()
    {
        return property_exists($this, 'hashFields');
    }

    public function getHashFieldsMapping(): array
    {
        return $this->hashFields;
    }

    public function save()
    {
        $this->resetErrorBag();

        $class = $this->getAction();

        $action = (new $class($this->state));

        if ($this->uuid) {
            $action->setConstrainedBy(['uuid' => $this->uuid]);
        }

        if ($this->hasUuid2idMapping()) {
            $action->setUuid2IdMapping($this->getUuid2IdMapping());
        }

        if ($this->hasHashFieldsMapping()) {
            $action->setHashFields($this->getHashFieldsMapping());
        }

        $action->execute();

        $this->handlFileUploads($action->getRecord());

        $this->resetState();

        if (! $this->edit && $this->uuid) {
            $this->uuid = '';
        }

        $this->emit('saved');
        $this->emit('refreshDatatable');

        $this->emitTo('alert', 'displayAlert', __($this->getFormTitle()), __($this->getFormTitle().' successfully saved'));

        $this->displayingModal = false;
    }

    public function create()
    {
        $this->edit = true;
        $this->displayingModal = true;
    }

    public function close()
    {
        $this->edit = false;
        $this->displayingModal = false;
    }

    public function show(string $uuid, bool $edit = false)
    {
        $this->uuid = $uuid;
        $this->edit = $edit;

        $this->record = $data = $this->getModel()::query()
            ->when(property_exists($this, 'eagerLoad'), fn ($query) => $query->with($this->eagerLoad))
            ->whereUuid($uuid)->firstOrFail();

        Gate::allows($edit ? 'update' : 'create', $data);

        $this->loadDependencies();

        $this->state = $this->toArray($data);
        $this->displayingModal = true;
    }

    public function loadDependencies()
    {

    }

    public function toArray(Model $model)
    {
        return $model->toArray();
    }

    public function destroy(string $uuid)
    {
        $model = $this->getModel()::whereUuid($uuid)->first();

        Gate::allows('delete', $model);

        $this->getModel()::whereUuid($uuid)->delete();

        $this->emit('refreshDatatable');

        $this->emitTo('alert', 'displayAlert', __($this->getFormTitle()), __($this->getFormTitle().' successfully deleted'));
    }

    public function getFormTitle(): string
    {
        return $this->formTitle;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function render()
    {
        return view($this->getView());
    }

    public function handlFileUploads(Model $model)
    {
    }
}
