<?php

namespace App\Models;

use CleaniqueCoders\Traitify\Concerns\InteractsWithUuid;
use OwenIt\Auditing\Auditable as AuditingTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends \Spatie\Permission\Models\Role implements Auditable
{
    use AuditingTrait;
    use InteractsWithUuid;
}
