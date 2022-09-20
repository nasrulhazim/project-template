<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;

class ContractCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:contract';

    /**
     * The console create a new Contract class.
     *
     * @var string
     */
    protected $description = 'Create a new contract class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/contract.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
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
        return $rootNamespace.'\\Contracts';
    }
}
