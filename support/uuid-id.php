<?php

use App\Exceptions\ThrowException;

if (! function_exists('uuid2id')) {
    function uuid2id(string $uuid, string $class): int
    {
        ThrowException::unless(class_exists($class), null, "$class did not exists");

        $object = $class::whereUuid($uuid)->firstOrFail();

        return $object->id;
    }
}

if (! function_exists('id2uuid')) {
    function id2uuid(int $id, string $class): string
    {
        ThrowException::unless(class_exists($class), null, "$class did not exists");

        $object = $class::whereId($id)->firstOrFail();

        return $object->uuid;
    }
}
