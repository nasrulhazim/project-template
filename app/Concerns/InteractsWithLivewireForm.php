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

        if (method_exists($this, 'afterMount')) {
            $this->afterMount();
        }
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

        if (method_exists($this, 'beforeSave')) {
            $this->beforeSave();
        }

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

        $this->record = $action->getRecord();

        if (method_exists($this, 'handleFilesUpload')) {
            $this->handleFilesUpload($action->getRecord());
        }

        if (method_exists($this, 'afterSave')) {
            $this->afterSave();
        }

        $this->resetState();

        if (! $this->edit && $this->uuid) {
            $this->uuid = '';
        }

        $this->dispatch('saved');

        $this->dispatch('refreshDatatable');

        $this->dispatch(
            'displayAlert',
            title: __($this->getFormTitle()),
            message: __($this->getFormTitle().' successfully saved'))
            ->to('alert');

        $this->displayingModal = false;
    }

    public function create()
    {
        $this->edit = true;
        $this->displayingModal = true;
    }

    public function close()
    {
        if (method_exists($this, 'beforeClose')) {
            $this->beforeClose();
        }

        $this->edit = false;
        $this->displayingModal = false;

        if (method_exists($this, 'afterClose')) {
            $this->afterClose();
        }
    }

    public function show(string $uuid, bool $edit = false)
    {
        $this->uuid = $uuid;
        $this->edit = $edit;

        $data = $this->loadRecord()->getRecord();

        Gate::allows($edit ? 'update' : 'create', $data);

        if (method_exists($this, 'loadDependencies')) {
            $this->loadDependencies();
        }

        $this->state = $this->toArray($data);
        $this->displayingModal = true;
    }

    public function getRecord()
    {
        return $this->record;
    }

    public function loadRecord()
    {
        $this->record = $this->getModel()::query()
            ->when(property_exists($this, 'eagerLoad'), fn ($query) => $query->with($this->eagerLoad))
            ->whereUuid($this->uuid)->firstOrFail();

        return $this;
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

        $this->dispatch('refreshDatatable');

        $this->dispatch('displayAlert', __($this->getFormTitle()), __($this->getFormTitle().' successfully deleted'))->to('alert');
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
}
