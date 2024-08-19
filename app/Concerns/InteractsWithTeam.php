<?php

namespace App\Concerns;

use App\Models\Team;
use App\Scopes\Team as TeamScope;
use Illuminate\Support\Facades\Schema;

trait InteractsWithTeam
{
    public static function bootInteractsWithTeam()
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'team_id') && is_null($model->team_id)) {
                $model->team_id = auth()->user()->currentTeam->id;
            }
        });
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::booted();

        static::addGlobalScope(new TeamScope);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
