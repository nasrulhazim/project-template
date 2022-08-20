<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Command;

class PageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:page {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare common classes for a page';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('make:model', [
            'name' => $this->argument('name'),
            '--controller' => true,
            '--factory' => true,
            '--migration' => true,
            '--resource' => true,
            '--pest' => true,
            '--seed' => true,
        ]);
        $this->call('make:action', [
            'name' => $this->argument('name') . 'Action',
            '--model' => $this->argument('name'),
        ]);
        $this->call('make:livewire-form', [
            'name' => $this->argument('name'),
        ]);
        $this->call('make:datatable', [
            'name' => $this->argument('name') . 'Datatable',
            'model' => $this->argument('name'),
        ]);
        $this->call('make:route', [
            'name' => $this->argument('name'),
        ]);

        return 0;
    }
}
