<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface Api
{
    public function getApiResponse(Request $request): array;

    public function getData(Request $request): array;

    public function getMessage(): string;

    public function getCode(): int;
}
