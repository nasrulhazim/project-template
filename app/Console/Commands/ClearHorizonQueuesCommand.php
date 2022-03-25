<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearHorizonQueuesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horizon:clear-all-queues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all queues under horizon';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (config('horizon.defaults') as $key => $value) {
            $queues = $value['queue'];
            foreach ($queues as $queue) {
                $this->call('queue:clear', [
                    'connection' => $value['connection'],
                    '--queue' => $queue,
                ]);
            }
        }

        return 0;
    }
}
