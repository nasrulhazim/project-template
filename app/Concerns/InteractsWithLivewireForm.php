<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;

trait InteractsWithLivewireForm
{
    public string $uuid = '';
    public $displayingModal = false;
    protected $default_state = [];

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
        return property_exists($this, 'uuid2id');
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

        if ($this->uuid) {
            $this->uuid = '';
        }

        $this->emit('saved');
        $this->emit('refreshDatatable');

        $this->displayingModal = false;
    }

    public function show(string $uuid)
    {
        $this->uuid = $uuid;
        $data = $this->getModel()::whereUuid($uuid)->firstOrFail();
        $this->state = $data->toArray();
        $this->displayingModal = true;
    }

    public function destroy(string $uuid)
    {
        $this->getModel()::whereUuid($uuid)->delete();

        $this->emit('refreshDatatable');

        $this->emitTo('alert', 'displayAlert',  __($this->getFormTitle()), __($this->getFormTitle() . ' succesfully deleted'));
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
