<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
