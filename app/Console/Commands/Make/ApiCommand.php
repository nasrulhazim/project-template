<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Command;

class ApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Scaffold API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        foreach (['delete', 'get', 'list', 'store', 'update'] as $key => $value) {
            $this->call('make:api-action', [
                'name' => $name,
                '--'.$value => true,
            ]);
        }

        $controller = "Api/$name".'Controller';
        $model = $name;

        $this->call('make:controller', [
            'name' => $controller,
            '--model' => $model,
            '--api' => true,
            '--force' => true,
        ]);

    }
}
