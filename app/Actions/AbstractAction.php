<?php

namespace App\Actions;

use App\Contracts\Execute;
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

    public function execute()
    {
        Validator::make(
            $this->inputs(),
            $this->rules()
        )->validate();
    }
}
