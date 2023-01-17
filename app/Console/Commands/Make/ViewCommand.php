<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ViewCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:view';

    /**
     * The console create a new view file.
     *
     * @var string
     */
    protected $description = 'Create a new view file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('index')) {
            return $this->resolveStubPath('/stubs/view/index.stub');
        }

        if ($this->option('show')) {
            return $this->resolveStubPath('/stubs/view/show.stub');
        }

        if ($this->option('form')) {
            return $this->resolveStubPath('/stubs/view/form.stub');
        }

        return $this->resolveStubPath('/stubs/view/blank.stub');
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
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['[name]', '[title]'], [strtolower($class), Str::of($class)->title()], $stub);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $directory = Str::of($name)
            ->replaceFirst($this->rootNamespace(), '')
            ->kebab()
            ->lower();

        $name = 'view';

        if ($this->option('index')) {
            $name = 'index';
        } elseif ($this->option('show')) {
            $name = 'show';
        } elseif ($this->option('form')) {
            $name = 'form';
        }

        return resource_path(
            'views/'.str_replace('\\', '/', strtolower($directory)).'/'.$name.'.blade.php'
        );
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
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['index', null, InputOption::VALUE_NONE, 'Create a list view'],
            ['show', null, InputOption::VALUE_NONE, 'Create a show details view'],
            ['form', null, InputOption::VALUE_NONE, 'Create a form view'],
        ];
    }
}
