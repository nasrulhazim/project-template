<?php

namespace App\Console\Commands\Reload;

use Illuminate\Console\Command;

class CacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reload:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload all caches';

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
        if (file_exists(config('livewire-domain.manifest_path'))) {
            unlink(config('livewire-domain.manifest_path'));
        }
        $this->call('event:clear');
        $this->call('optimize:clear');
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('config:clear');
        $this->call('cache:clear');

        $this->info('Successfully reload caches.');
    }
}
