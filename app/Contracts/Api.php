<?php

namespace App\Contracts;

interface Api
{
    public function getApiResponse();

    public function getData(): array;

    public function getMessage(): string;

    public function getCode(): int;
}
