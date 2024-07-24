<?php

namespace App\Console\Commands;

use App\Actions\Poster\GeneratePosterAction;
use App\Models\Tenant;
use Illuminate\Console\Command;

class PosterGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poster:generate
                            {tenant : The ID of a tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a poster for the given tenant.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $tenant = Tenant::findOrFail(
            $this->argument('tenant')
        );

        $action = new GeneratePosterAction();

        $this->info($action->handle($tenant));
    }
}
