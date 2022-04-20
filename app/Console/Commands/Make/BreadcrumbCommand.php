<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class BreadcrumbCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:breadcrumb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new breadcrumb';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Breadcrumb';

    public function handle()
    {
        parent::handle();

        $name = $this->qualifyClass($this->getNameInput());

        $path = str_replace(base_path('/routes/'), '', $this->getPath($name));

        $this->files->append(base_path('/routes/breadcrumbs.php'), PHP_EOL . "require '${path}';");
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return $this->resolveStubPath('/stubs/breadcrumb-resource.stub');
        }

        return $this->resolveStubPath('/stubs/breadcrumb.stub');
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
        $name = Str::of($name)
            ->replaceFirst($this->rootNamespace(), '')
            ->kebab();

        return base_path('/routes/breadcrumbs/'.str_replace('\\', '/', $name).'.php');
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
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $name = Str::of($name)
            ->replace($this->getNamespace($name).'\\', '', $name)
            ->plural();
        $route_prefix = $name->kebab();
        $label = $name->title();

        return str_replace(
            ['{{ route_prefix }}', '{{ label }}'],
            [
                $route_prefix,
                $label,
            ],
            $stub
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', 'r', InputOption::VALUE_NONE, 'Create a resourceful breadcrumb'],
        ];
    }
}
