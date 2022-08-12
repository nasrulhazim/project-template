<?php

namespace App\Concerns;

trait InteractsWithLivewireForm
{
    public string $uuid = '';
    public $displayingModal = false;

    public function getModel(): string
    {
        return $this->model;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function save()
    {
        $this->resetErrorBag();

        $class = $this->getAction();

        $action = (new $class($this->state));

        if ($this->uuid) {
            $action->setConstrainedBy(['uuid' => $this->uuid]);
        }

        $action->execute();

        $this->state = [];

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
}
