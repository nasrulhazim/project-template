<?php

namespace App\View;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ActionColumn extends Column
{
    protected string $form = '';

    protected string $actionView = '';

    public function form(string $form): self
    {
        $this->form = $form;

        return $this;
    }

    public function setView($actionView): self
    {
        $this->actionView = $actionView;

        return $this;
    }

    public function getView(): string
    {
        return $this->actionView === '' || $this->actionView === '0' ? 'livewire.datatable-actions' : $this->actionView;
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|\Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView(), ['form' => $this->form])
            ->withColumn($this)
            ->withRow($row);
    }
}
