<?php

namespace App\Models;

use App\Concerns\InteractsWithUuid;
use OwenIt\Auditing\Auditable as AuditingTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends \Spatie\Permission\Models\Permission implements Auditable
{
    use AuditingTrait;
    use InteractsWithUuid;
}
