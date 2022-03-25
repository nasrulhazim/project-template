<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
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
        if ($this->option('create')) {
            return $this->resolveStubPath('/stubs/action-create.stub');
        }

        if ($this->option('update')) {
            return $this->resolveStubPath('/stubs/action-update.stub');
        }

        if ($this->option('delete')) {
            return $this->resolveStubPath('/stubs/action-delete.stub');
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
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Actions';
    }

    /**
    * Get the console command options.
    *
    * @return array
    */
    protected function getOptions()
    {
        return [
            ['create', 'c', InputOption::VALUE_NONE, 'Create a new create action'],
            ['delete', 'd', InputOption::VALUE_NONE, 'Create a new delete action'],
            ['update', 'u', InputOption::VALUE_NONE, 'Create a new update action'],
        ];
    }
}
