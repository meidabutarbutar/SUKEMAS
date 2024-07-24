<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Collector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collector:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To run cache-related garbage collection.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // manually clean up event cache
        $this->call('event:clear', []);

        // manually clean up view cache
        $this->call('view:clear', []);

        // manually clean up application cache
        $this->call('cache:clear', []);

        // manually clean up route cache
        $this->call('route:clear', []);

        // manually clean up config cache
        $this->call('config:clear', []);

        // clean up all caches in case something was left
        $this->call('optimize:clear', []);
    }
}
