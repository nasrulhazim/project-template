<?php

namespace App\Models;

use CleaniqueCoders\Traitify\Concerns\InteractsWithUuid;

class Audit extends \OwenIt\Auditing\Models\Audit
{
    use InteractsWithUuid;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
