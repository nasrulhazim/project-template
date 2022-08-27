<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use RuntimeException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ActionCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:action';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new action class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Action';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('menu')) {
            return $this->resolveStubPath('/stubs/action-menu.stub');
        }

        if ($this->option('api')) {
            return $this->resolveStubPath('/stubs/action-api.stub');
        }

        return $this->resolveStubPath('/stubs/action.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     *
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
                        ? $customPath
                        : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->option('menu')) {
            return $rootNamespace.'\Actions\Builder\Menu';
        }

        if ($this->option('api')) {
            return $rootNamespace.'\Actions\Api';
        }

        return $rootNamespace.'\Actions';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceModel($stub)
            ->replaceClass($stub, $name);
    }

    protected function replaceModel(&$stub)
    {
        $this->throwExceptionIfMissingModel();

        if (! $this->option('model')) {
            return $this;
        }

        $stub = str_replace(
            ['{{ model_namespace }}', '{{ model }}'],
            [$this->getModelNamespace(), $this->getModel()],
            $stub
        );

        return $this;
    }

    protected function getModelNamespace()
    {
        return 'App\\Models\\' . $this->getModel();
    }

    public function throwExceptionIfMissingModel()
    {
        if (empty($this->option('model')) && ! $this->option('menu') && ! $this->option('api')) {
            throw new RuntimeException('Missing model option.');
        }
    }

    public function getModel()
    {
        $this->throwExceptionIfMissingModel();

        return $this->option('model');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', '', InputOption::VALUE_REQUIRED, 'The name of the model'],
            ['menu', '', InputOption::VALUE_NONE, 'Create a menu action'],
            ['api', '', InputOption::VALUE_NONE, 'Create an API action'],
        ];
    }
}
