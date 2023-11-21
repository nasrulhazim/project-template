<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PrepareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(AccessControlSeeder::class);
        $this->createSuperUser();
    }

    private function createSuperUser()
    {
        $user = (new CreateNewUser())->create(config('seeder.users.superadmin'));
        $user->assignRole('superadmin');
        $user->assignRole('user');
        $user->update(['email_verified_at' => now()]);
    }
}
