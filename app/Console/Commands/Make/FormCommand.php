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
     *
     * @return int
     */
    public function handle()
    {
        $this->call('make:livewire', [
            'name' => 'Forms\\' . $this->argument('name'),
        ]);

        $this->comment('See ' . base_path('stubs/livewire.form.stub') . ' for additional setup for the class');
        $this->comment('See ' . base_path('stubs/livewire.form.view.stub') . ' for additional setup for the view');

        return 0;
    }
}
