<?php

namespace App\Exceptions;

use App\Concerns\InteractsWithExceptions;
use Exception;

class ThrowException extends Exception
{
    use InteractsWithExceptions;
}
