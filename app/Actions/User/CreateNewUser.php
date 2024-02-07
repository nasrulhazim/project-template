<?php

namespace App\Actions\User;

use App\Actions\Fortify\PasswordValidationRules;
use App\Concerns\InteractsWithUuidInAction;
use App\Models\User;
use CleaniqueCoders\LaravelAction\AbstractAction as Action;

class CreateNewUser extends Action
{
    use InteractsWithUuidInAction;
    use PasswordValidationRules;

    public $model = User::class;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ];
    }
}
