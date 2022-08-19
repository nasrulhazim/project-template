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
    protected array $uuid2id = [];

    public function __construct(public array $inputs)
    {
    }

    public function setInputs(array $inputs): self
    {
        $this->inputs = $inputs;

        return $this;
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

    public function setUuid2IdMapping(array $uuid2id): self
    {
        $this->uuid2id = $uuid2id;

        return $this;
    }

    public function getUuid2IdMapping(): array
    {
        return $this->uuid2id; // return list of array with key-value, key = property, value = model
    }

    public function hasUuid2idMapping(): bool
    {
        return property_exists($this, 'uuid2id') && count($this->getUuid2IdMapping()) > 0;
    }

    public function transformUuid2Id()
    {
        if ($this->hasUuid2idMapping()) {
            // get from constrainedBy
            if ($this->hasConstrained()) {
                $constrainedBy = $this->getConstrainedBy();
                foreach ($this->getUuid2IdMapping() as $key => $value) {
                    $uuid = $constrainedBy[$key];
                    if (! empty($uuid)) {
                        $constrainedBy[$key] = uuid2id($uuid, $value);
                    }
                }
                $this->setConstrainedBy($constrainedBy);
            }
            // get from inputs
            $inputs = $this->inputs();
            foreach ($this->getUuid2IdMapping() as $key => $value) {
                $uuid = $inputs[$key];

                if (! empty($uuid)) {
                    $inputs[$key] = uuid2id($uuid, $value);
                }
            }
            $this->setInputs($inputs);
        }
    }

    public function inputs(): array
    {
        return $this->inputs;
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
        $this->transformUuid2Id();

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
