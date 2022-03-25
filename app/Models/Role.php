<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    protected $guarded = [
        'id',
    ];
}