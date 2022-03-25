<?php

namespace App\Console\Commands\Reload;

use Illuminate\Console\Command;

class AllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reload:all
                                {--m|demo : Seed demo data}
                                {--d|dev : Seed development data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload all caches and database.';

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
        $this->call('reload:cache');
        $this->call('reload:db');

        if ($this->option('dev')) {
            $this->call('seed:dev');
        }

        if ($this->option('demo')) {
            $this->call('seed:demo');
        }

        $this->info('Successfully reload caches and database.');
    }
}
