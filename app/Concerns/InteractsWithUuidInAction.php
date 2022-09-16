<?php 

namespace App\Concerns;

trait InteractsWithUuidInAction
{
    protected array $uuid2id = [];

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
                    $uuid = data_get($constrainedBy, $key);
                    if (! empty($uuid)) {
                        $constrainedBy[$key] = uuid2id($uuid, $value);
                    }
                }
                $this->setConstrainedBy($constrainedBy);
            }
            // get from inputs
            $inputs = $this->inputs();
            foreach ($this->getUuid2IdMapping() as $key => $value) {
                $uuid = data_get($inputs, $key);

                if (! empty($uuid)) {
                    $inputs[$key] = uuid2id($uuid, $value);
                }
            }
            $this->setInputs($inputs);
        }
    }

    public function prepare()
    {
        $this->transformUuid2Id();
    }
}