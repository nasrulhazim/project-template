<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->withPersonalTeam()
            ->count(1000)
            ->create()
            ->each(function ($user) {
                $user->assignRole('user');
            });
    }
}
