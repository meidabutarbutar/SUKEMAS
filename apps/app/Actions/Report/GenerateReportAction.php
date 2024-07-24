<?php

namespace App\Actions\Report;

use App\Models\Tenant;
use Exception;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class GenerateReportAction
{
    protected ?Tenant $tenant = null;

    protected string $subdir = 'report';

    public function tenant(Tenant $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function subdir(string $subdir): static
    {
        $this->subdir = $subdir;

        return $this;
    }

    public function handle(Tenant $tenant = null): string
    {
        if ($tenant) {
            $this->tenant($tenant);
        }

        if (!$this->tenant) {
            throw new Exception('No valid Tenant.');
        }

        $url = route('public-report', ['tenant' => $this->tenant->token]);

        $reportFilePath = Storage::disk('public')
            ->path("/{$this->subdir}/{$this->tenant->token}.pdf");

        Browsershot::url($url)
            ->save($reportFilePath);

        logger()->info('Generating Report', [
            'tenant' => $this->tenant->id,
            'url' => $url,
            'path' => $reportFilePath,
        ]);

        return $reportFilePath;
    }
}
