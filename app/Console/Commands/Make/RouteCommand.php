<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class RouteCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new route';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Route';

    public function handle()
    {
        parent::handle();

        $name = $this->qualifyClass($this->getNameInput());

        $path = str_replace(base_path('/routes/'), '', $this->getPath($name));

        $this->files->append(base_path('/routes/web.php'), PHP_EOL . "require '${path}';");
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return $this->resolveStubPath('/stubs/route-resource.stub');
        }

        return $this->resolveStubPath('/stubs/route.stub');
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

        return base_path('/routes/web/'.str_replace('\\', '/', $name).'.php');
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
        if ($this->option('resource')) {
            return str_replace(
                ['{{ uri }}', '{{ class }}'],
                [
                    Str::of($name)
                        ->replace($this->getNamespace($name).'\\', '', $name)
                        ->plural()
                        ->kebab(),
                    $this->option('resource').'::class',
                ],
                $stub
            );
        }

        return parent::replaceClass($stub, $name);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', 'r', InputOption::VALUE_REQUIRED, 'Create a resourceful route'],
        ];
    }
}
