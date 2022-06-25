<?php

namespace App\Concerns;

use Illuminate\Http\Request;

trait InteractsWithApi
{
    public function getApiResponse(Request $request): array
    {
        return [
            'data' => $this->getData($request),
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ];
    }

    public function getData(Request $request): array
    {
        return self::toArray($request);
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
