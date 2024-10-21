<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ApiActionCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:api-action';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API Action';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Actions API';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        if ($this->option('delete')) {
            return $this->resolveStubPath('/stubs/api/action.delete.stub');
        }

        if ($this->option('get')) {
            return $this->resolveStubPath('/stubs/api/action.get.stub');
        }

        if ($this->option('list')) {
            return $this->resolveStubPath('/stubs/api/action.list.stub');
        }

        if ($this->option('store')) {
            return $this->resolveStubPath('/stubs/api/action.store.stub');
        }

        if ($this->option('update')) {
            return $this->resolveStubPath('/stubs/api/action.update.stub');
        }

        return $this->resolveStubPath('/stubs/api/action.stub');
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $model = class_basename($this->qualifyModel($name));

        return str_replace(
            ['{{ namespace }}', '{{ model }}'],
            [
                $model, $model,
            ],
            $stub);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $base = class_basename($name);
        $filename = '';

        if ($this->option('delete')) {
            $filename = "Delete$base";
        }

        if ($this->option('get')) {
            $filename = "Get$base";
        }

        if ($this->option('list')) {
            $filename = "Get$base".'List';
        }

        if ($this->option('store')) {
            $filename = "Store$base";
        }

        if ($this->option('update')) {
            $filename = "Update$base";
        }

        $name = str($name)
            ->replaceFirst($this->rootNamespace(), '')
            ->studly();
        $path = base_path('/app/Actions/Api/'.str_replace('\\', '/', $base).'/'.str_replace('\\', '/', $filename).'.php');

        return $path;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Actions\Api\\'.$this->getNameInput();
    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
                        ? $customPath
                        : __DIR__.$stub;
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['delete', null, InputOption::VALUE_NONE, 'Create a delete API action'],
            ['get', null, InputOption::VALUE_NONE, 'Create a get API action'],
            ['list', null, InputOption::VALUE_NONE, 'Create a list API action'],
            ['store', null, InputOption::VALUE_NONE, 'Create a store API action'],
            ['update', null, InputOption::VALUE_NONE, 'Create a update API action'],
        ];
    }
}
