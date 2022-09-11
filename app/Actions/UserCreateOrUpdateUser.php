<?php

namespace App\Actions;

use App\Models\User;
use Bekwoh\LaravelAction\AbstractAction as Action;

class UserCreateOrUpdateUser extends Action
{
    public $model = User::class;

    public function rules(): array
    {
        return [];
    }
}
