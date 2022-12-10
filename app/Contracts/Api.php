<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface Api
{
    public function getApiResponse(Request $request): array;

    public function getData(Request $request): JsonResource|ResourceCollection|array;

    public function getMessage(): string;

    public function getCode(): int;
}
