<?php

namespace App\Actions;

use App\Contracts\Execute;
use App\Exceptions\ActionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

abstract class AbstractAction implements Execute
{
    abstract public function rules(): array;

    public function __construct(protected array $input)
    {
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
            $this->inputs(),
            $this->rules()
        )->validate();


        return DB::transaction(function () {
            return $this->model()::create($this->inputs());
        });
    }
}
