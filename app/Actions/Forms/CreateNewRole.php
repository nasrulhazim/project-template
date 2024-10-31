<?php

namespace App\Actions\Forms;

use App\Models\Role as Model;
use CleaniqueCoders\LaravelAction\ResourceAction as Action;

class CreateNewRole extends Action
{
    public string $model = Model::class;

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'display_name' => ['required'],
            'description' => ['required'],
        ];
    }
}
