<?php

namespace App\Concerns;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait InteractsWithApi
{
    protected $code = 200;

    public function getApiResponse(Request $request): array
    {
        return [
            'data' => $this->getData($request),
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ];
    }

    public function getData(Request $request): JsonResource | ResourceCollection | array
    {
        return self::toArray($request);
    }

    public function getMessage(): string
    {
        return '';
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
