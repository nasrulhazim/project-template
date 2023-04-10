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
    public function handle(): int
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
            '--all' => true,
            '--force' => true,
        ]);

        $this->comment('Do add $this->authorize(); in your controller.');
        $this->comment('Do add return view() in your controller.');
        $this->comment('Refer app/Models/UserController.php for more details.');

        $this->call('make:action', [
            'name' => 'Forms\\'.$name,
            '--model' => $name,
        ]);
        $this->call('make:form', [
            'name' => $name,
        ]);
        $this->call('make:datatable', [
            'name' => 'Datatable\\'.$name,
            'model' => $name,
            '--force' => true,
        ]);
        $this->call('make:route', [
            'name' => $name,
            '--resource' => true,
        ]);
        $this->call('make:view', [
            'name' => $name,
            '--index' => true,
        ]);
        $this->call('make:view', [
            'name' => $name,
            '--show' => true,
        ]);
        $this->call('make:view', [
            'name' => $name,
            '--form' => true,
        ]);
    }
}
