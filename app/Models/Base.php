<?php

namespace App\Models;

use CleaniqueCoders\Traitify\Concerns\InteractsWithMeta;
use CleaniqueCoders\Traitify\Concerns\InteractsWithResourceRoute;
use CleaniqueCoders\Traitify\Concerns\InteractsWithSearchable;
use CleaniqueCoders\Traitify\Concerns\InteractsWithToken;
use CleaniqueCoders\Traitify\Concerns\InteractsWithUser;
use CleaniqueCoders\Traitify\Concerns\InteractsWithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Base extends Model implements AuditableContract, HasMedia
{
    use AuditableTrait;
    use HasFactory;
    use InteractsWithMedia;
    use InteractsWithMeta;
    use InteractsWithResourceRoute;
    use InteractsWithSearchable;
    use InteractsWithToken;
    use InteractsWithUser;
    use InteractsWithUuid;

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'id',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(130)
            ->height(130);
    }
}
