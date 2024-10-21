<?php

namespace App\Enums;

use CleaniqueCoders\Traitify\Concerns\InteractsWithEnum;
use CleaniqueCoders\Traitify\Contracts\Enum as Contract;

enum Status implements Contract
{
    use InteractsWithEnum;

    case ACTIVE;
    case INACTIVE;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => __('Active'),
            self::INACTIVE => __('Inactive'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ACTIVE => __('Status is active.'),
            self::INACTIVE => __('Status is inactive.'),
        };
    }
}
