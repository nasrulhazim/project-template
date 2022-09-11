<?php

namespace App\Actions\User;

use App\Models\User;
use Bekwoh\LaravelAction\AbstractAction as Action;

class CreateOrUpdateUser extends Action
{
    public $model = User::class;

    public function rules(): array
    {
        return [];
    }
}
