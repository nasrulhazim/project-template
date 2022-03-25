<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;

class HelperCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new helper';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Helper';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/helper.stub');
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = \Illuminate\Support\Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('/support/'.str_replace('\\', '/', $name).'.php');
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
}
