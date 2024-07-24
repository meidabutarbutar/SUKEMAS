<?php

namespace App\Console\Commands;

use App\Actions\Poster\GeneratePosterAction;
use App\Models\Tenant;
use Illuminate\Console\Command;

class Experiment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'experiment:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An experimental playground';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $tenant = Tenant::findOrFail(1);

        $action = new GeneratePosterAction();

        $path = $action->handle($tenant);

        print_r($path);
    }
}
