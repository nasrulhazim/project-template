<?php

namespace App\Models;

use App\Concerns\InteractsWithMeta;
use App\Concerns\InteractsWithResourceRoute;
use App\Concerns\InteractsWithToken;
use App\Concerns\InteractsWithUser;
use App\Concerns\InteractsWithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Base extends Model implements AuditableContract, HasMedia
{
    use HasFactory;
    use InteractsWithMeta;
    use InteractsWithToken;
    use InteractsWithUuid;
    use InteractsWithUser;
    use InteractsWithMedia;
    use InteractsWithResourceRoute;
    use AuditableTrait;

    protected $guarded = [
        'id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(130)
            ->height(130);
    }
}
