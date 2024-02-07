<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AccessControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedRoles();
        $this->seedPermissions();
        $this->mapPermissionRole();
    }

    private function seedRoles()
    {
        foreach (config('access-control.roles') as $role => $description) {
            Role::updateOrCreate([
                'name' => $role,
                'display_name' => str($role)->headline()->toString(),
                'guard_name' => 'web',
            ], [
                'description' => $description,
            ]);
        }
    }

    private function seedPermissions()
    {
        collect(config('access-control.permissions'))
            ->each(function ($permission) {
                $module = $permission['module'];
                $functions = $permission['functions'];

                foreach ($functions as $function => $operations) {
                    foreach ($operations as $operation) {
                        Permission::updateOrCreate([
                            'module' => $module,
                            'function' => str($function)
                                ->replace('-', ' ')
                                ->title()
                                ->toString(),
                            'name' => $operation.'-'.$function.'-'.str($module)->kebab()->toString(),
                            'guard_name' => 'web',
                        ]);
                    }
                }
            });

        collect(config('access-control.generic_permissions'))
            ->each(function ($permission) {
                Permission::updateOrCreate([
                    'name' => $permission,
                    'guard_name' => 'web',
                ]);
            });
    }

    private function mapPermissionRole()
    {
        foreach (config('access-control.roles_permissions') as $permission => $roles) {
            $roles = Role::whereIn('name', $roles)->get();
            foreach ($roles as $role) {
                if ($role && ! $role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
