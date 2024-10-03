<?php

namespace App\Models;

use App\Concerns\InteractsWithMeta;
use App\Concerns\InteractsWithResourceRoute;
use App\Concerns\InteractsWithToken;
use App\Concerns\InteractsWithUser;
use App\Concerns\InteractsWithUuid;
use App\Concerns\Scopes\Searchable;
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
    use InteractsWithToken;
    use InteractsWithUser;
    use InteractsWithUuid;
    use Searchable;

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
