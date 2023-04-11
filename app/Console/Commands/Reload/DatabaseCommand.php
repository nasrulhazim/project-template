<?php

namespace App\Console\Commands\Reload;

use Illuminate\Console\Command;

class DatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reload:db
                                {--m|demo : Seed demo data}
                                {--d|dev : Seed development data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload Database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (app()->environment() === 'production') {
            $this->comment('Nothing need to be done here. Bye.');

            return 0;
        }
        $this->call('migrate:fresh', ['--quiet' => true]);
        $this->call('seed:prepare', ['--quiet' => true]);

        if ($this->option('dev')) {
            $this->call('seed:dev');
        }
        
        $this->call('db:schema');

        $this->info('Successfully reload database.');

        return Command::SUCCESS;
    }
}
