<?php

namespace App\Actions;

use App\Contracts\Execute;
use App\Exceptions\ActionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

abstract class AbstractAction implements Execute
{
    abstract public function rules(): array;

    protected array $constrainedBy = [];

    public function __construct(protected array $input)
    {
    }

    public function setConstrainedBy(array $constrainedBy): self
    {
        $this->constrainedBy = $constrainedBy;

        return $this;
    }

    public function getConstrainedBy(): array
    {
        return $this->constrainedBy;
    }

    public function hasConstrained(): bool
    {
        return count($this->getConstrainedBy()) > 0;
    }

    public function inputs(): array
    {
        return $this->input;
    }

    public function model(): string
    {
        if (! property_exists($this, 'model')) {
            throw ActionException::missingModelProperty(__CLASS__);
        }

        return $this->model;
    }

    public function execute()
    {
        Validator::make(
            array_merge(
                $this->getConstrainedBy(),
                $this->inputs()
            ),
            $this->rules()
        )->validate();


        return DB::transaction(function () {
            return $this->hasConstrained()
                ? $this->model::updateOrCreate($this->getConstrainedBy(), $this->inputs())
                : $this->model::create($this->inputs());
        });
    }
}
