<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Actions\QRCode\GenerateQRCodeAction;
use Illuminate\Console\Command;

class QRCodeGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qrcode:generate
                            {tenant : The ID of a tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating a QRCode for a given tenant.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $tenant = Tenant::findOrFail(
            $this->argument('tenant')
        );

        $action = new GenerateQRCodeAction();

        $this->info($action->handle($tenant));
    }
}
