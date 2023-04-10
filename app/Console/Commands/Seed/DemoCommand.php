<?php

namespace App\Console\Commands\Seed;

use Illuminate\Console\Command;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Demo Data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->call('db:seed', [
            '--class' => '\Database\Seeders\DemoSeeder',
            '--quiet' => true,
        ]);
    }
}
