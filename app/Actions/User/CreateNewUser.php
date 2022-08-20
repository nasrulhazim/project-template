<?php

namespace App\Actions\User;

use App\Actions\AbstractAction as Action;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;

class CreateNewUser extends Action
{
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
