<?php

namespace App\Models;

use CleaniqueCoders\Traitify\Concerns\InteractsWithResourceRoute;
use CleaniqueCoders\Traitify\Concerns\InteractsWithUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Yadahan\AuthenticationLog\AuthenticationLogable;

class User extends Authenticatable implements AuditableContract, HasMedia, MustVerifyEmail
{
    use AuditableTrait;
    use AuthenticationLogable;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use HasTeams;
    use Impersonate;
    use InteractsWithMedia;
    use InteractsWithResourceRoute;
    use InteractsWithUuid;
    use Notifiable;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'uuid', 'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canImpersonate(): bool
    {
        return config('impersonate.enabled');
    }

    public function canBeImpersonated()
    {
        return ! $this->hasRole('superadmin');
    }

    public function hasNotifications()
    {
        return $this->notifications()->unread()->exists();
    }

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
