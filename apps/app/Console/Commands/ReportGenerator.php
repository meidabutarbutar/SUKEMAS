<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Actions\QRCode\GenerateQRCodeAction;
use App\Actions\Report\GenerateReportAction;
use Illuminate\Console\Command;

class ReportGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate
                            {tenant : The ID of a tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating a report for a given tenant.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $tenant = Tenant::findOrFail(
            $this->argument('tenant')
        );

        $action = new GenerateReportAction();

        print_r('file path: ' . $action->handle($tenant));
    }
}
