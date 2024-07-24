<?php

namespace App\Observers;

use App\Jobs\GenerateTenantFiles;
use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;

class TenantObserver
{
    /**
     * Handle the Tenant "creating" event.
     */
    public function creating(Tenant $tenant): void
    {
        if ($tenant->token) {
            return;
        }

        $tenant->generateToken();
    }

    /**
     * Handle the Tenant "created" event.
     */
    public function created(Tenant $tenant): void
    {
        // Dispatch a queued job to generate the tenant's QRCode
        GenerateTenantFiles::dispatch($tenant);
    }

    /**
     * Handle the Tenant "deleted" event.
     */
    public function deleted(Tenant $tenant): void
    {
        $this->deleteLogoFile($tenant->logo_path);
    }

    public function saved(Tenant $tenant): void
    {
        if ($tenant->isDirty('logo_path')) {
            $this->deleteLogoFile($tenant->getOriginal('logo_path'));
        }
    }

    protected function deleteLogoFile(?string $path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
