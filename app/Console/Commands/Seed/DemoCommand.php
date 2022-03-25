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
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('db:seed', [
            '--class' => '\Database\Seeders\DemoSeeder',
            '--quiet' => true,
        ]);
    }
}
