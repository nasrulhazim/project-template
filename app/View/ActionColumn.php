<?php

namespace App\View;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ActionColumn extends Column
{
    protected string $form;

    public function form(string $form): self
    {
        $this->form = $form;

        return $this;
    }

    public function setView($view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getView(): string
    {
        return property_exists($this, 'view') ? $this->view : 'livewire.datatable-actions';
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|\Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView(), ['form' => $this->form])
            ->withColumn($this)
            ->withRow($row);
    }
}
