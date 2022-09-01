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
    protected $signature = 'make:page {name*}';

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
        foreach ($this->argument('name') as $key => $value) {
            $this->createPage($value);
        }

        return 0;
    }

    private function createPage(string $name)
    {
        $this->call('make:model', [
            'name' => $name,
            '--controller' => true,
            '--factory' => true,
            '--migration' => true,
            '--resource' => true,
            '--pest' => true,
            '--seed' => true,
            '--policy' => true,
        ]);
        $this->call('make:action', [
            'name' => $name . 'Action',
            '--model' => $name,
        ]);
        $this->call('make:form', [
            'name' => $name,
        ]);
        $this->call('make:datatable', [
            'name' => $name . 'Datatable',
            'model' => $name,
        ]);
        $this->call('make:route', [
            'name' => $name,
            '--resource' => true,
        ]);
    }
}
