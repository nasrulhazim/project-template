<?php

namespace App\Console\Commands\Seed;

use Illuminate\Console\Command;

class DevCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Development Data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->call('db:seed', [
            '--class' => '\Database\Seeders\DevSeeder',
            '--quiet' => true,
        ]);
    }
}
