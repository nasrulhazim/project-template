<?php

namespace App\Enums;

use CleaniqueCoders\Traitify\Concerns\InteractsWithEnum;
use CleaniqueCoders\Traitify\Contracts\Enum as Contract;

enum Status: string implements Contract
{
    use InteractsWithEnum;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

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
