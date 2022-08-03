<?php

namespace App\Exceptions;

use Exception;

class ActionException extends Exception
{
    public static function missingModelProperty($class)
    {
        return new self("Missing model property in class $class");
    }
}
