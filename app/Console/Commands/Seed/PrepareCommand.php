<?php

namespace App\Console\Commands\Seed;

use Illuminate\Console\Command;

class PrepareCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:prepare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Preparing Application to Run';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('db:seed', [
            '--class' => '\Database\Seeders\PrepareSeeder',
            '--quiet' => true,
        ]);
    }
}
