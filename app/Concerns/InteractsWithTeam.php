<?php

namespace App\Concerns;

use App\Models\Team;
use App\Scopes\Team as TeamScope;

trait InteractsWithTeam
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::addGlobalScope(new TeamScope());
    }

    public static function bootInteractsWithTeam()
    {
        // do nothing atm
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
