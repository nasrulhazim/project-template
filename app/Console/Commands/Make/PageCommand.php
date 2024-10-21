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
    protected $signature = 'make:page {name*} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare common classes for a page';

    /**
     * Execute the console command.
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
        $force = $this->option('force') ? true : false;

        $this->callSilently('make:model', [
            'name' => $name,
            '--all' => true,
            '--force' => $force,
        ]);

        $this->components->info('MODEL CREATED  🤙');

        $this->callSilently('make:action', [
            'name' => 'Forms\\'.$name,
            '--model' => $name,
        ]);

        $this->components->info('ACTION CREATED  🤙');

        $this->callSilently('make:form', [
            'name' => $name,
        ]);

        $this->components->info('FORM CREATED  🤙');

        $this->callSilently('make:controller', [
            'name' => $name.'Controller',
            '--invokable' => true,
            '--force' => $force,
        ]);

        $this->callSilently('make:controller', [
            'name' => $name.'DetailsController',
            '--invokable' => true,
            '--force' => $force,
        ]);

        $this->callSilently('make:controller', [
            'name' => $name.'FormController',
            '--invokable' => true,
            '--force' => $force,
        ]);

        $this->components->info('CONTROLLERS CREATED  🤙');

        $this->callSilently('make:datatable', [
            'name' => 'Datatable\\'.$name,
            'model' => $name,
            '--force' => $force,
        ]);

        $this->components->info('DATATABLE CREATED  🤙');

        $this->callSilently('make:route', [
            'name' => $name,
            '--resource' => true,
        ]);

        $this->components->info('ROUTE CREATED  🤙');

        $this->callSilently('make:view', [
            'name' => $name,
            '--index' => true,
        ]);
        $this->callSilently('make:view', [
            'name' => $name,
            '--show' => true,
        ]);
        $this->callSilently('make:view', [
            'name' => $name,
            '--form' => true,
        ]);

        $this->components->info('VIEWS CREATED  🤙');

        $this->components->warn('Do add $this->authorize(); in your controller.');
        $this->components->warn('Do add return view() in your controller.');
    }
}
