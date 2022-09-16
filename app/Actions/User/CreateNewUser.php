<?php

namespace App\Actions\User;

use App\Actions\Fortify\PasswordValidationRules;
use App\Concerns\InteractsWithUuidInAction;
use App\Models\User;
use Bekwoh\LaravelAction\AbstractAction as Action;

class CreateNewUser extends Action
{
    use PasswordValidationRules;
    use InteractsWithUuidInAction;

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
