<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Command;

class FormCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:form {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Livewire Form';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->call('make:livewire', [
            'name' => 'Forms\\'.$this->argument('name'),
            '--stub' => 'livewire-form',
            '--force' => true,
        ]);

        return 0;
    }
}
