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

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        if ($this->option('resource')) {
            return $this->resolveStubPath('/stubs/route-resource.stub');
        }

        return $this->resolveStubPath('/stubs/route.stub');
    }

    /**
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        $name = Str::of($name)
            ->replaceFirst($this->rootNamespace(), '')
            ->kebab();

        return base_path('/routes/web/'.str_replace('\\', '/', $name).'.php');
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
     * Replace the class name for the given stub.
     */
    protected function replaceClass(string $stub, string $name): string
    {
        if ($this->option('resource')) {
            return str_replace(
                ['{{ uri }}', '{{ class }}'],
                [
                    Str::of($name)
                        ->replace($this->getNamespace($name).'\\', '', $name)
                        ->plural()
                        ->kebab(),
                    Str::of($name)
                        ->replace(
                            $this->getNamespace($name).'\\', '\\App\\Http\\Controllers\\', $name
                        ),
                ],
                $stub
            );
        }

        return parent::replaceClass($stub, $name);
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['resource', 'r', InputOption::VALUE_REQUIRED, 'Create a resourceful route'],
        ];
    }
}
