<?php 

namespace App\Concerns;

trait InteractsWithApi
{
    public function getApiResponse()
    {
        return [
            'data' => $this->getData(),
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ];
    }

    public function getData(): array
    {
        return self::toArray();
    }

    public function getMessage(): string
    {
        return '';
    }

    public function getCode(): int 
    {
        return 200;
    }
}