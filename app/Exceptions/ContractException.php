<?php

namespace App\Exceptions;

use App\Concerns\InteractsWithExceptions;
use Exception;

class ContractException extends Exception
{
    use InteractsWithExceptions;

    public static function missingContract(string $class, string $contract)
    {
        return new self("$class did not implements $contract");
    }
}
