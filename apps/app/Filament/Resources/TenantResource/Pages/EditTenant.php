<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Filament\Resources\Pages\EditRecord;

class EditTenant extends EditRecord
{
    protected static string $resource = TenantResource::class;

    protected function getBreadcrumbs(): array
    {
        $resource = static::getResource();

        $breadcrumbs = [
            // $resource::getUrl() => $resource::getBreadcrumb(),
        ];

        if ($this->getRecord()->exists && $resource::hasRecordTitle()) {

            if ($resource::hasPage('view') && $resource::canView($this->getRecord())) {
                $breadcrumbs[$resource::getUrl('view', ['record' => $this->getRecord()])] = $this->getRecordTitle();
            } elseif ($resource::hasPage('edit') && $resource::canEdit($this->getRecord())) {
                $breadcrumbs[$resource::getUrl('edit', ['record' => $this->getRecord()])] = $this->getRecordTitle();
            }

            $breadcrumbs[] = $this->getRecordTitle();
        }

        return $breadcrumbs;
    }

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function resolveRecord($key): Model
    {
        $loggedInOperator = auth()->user();

        $key = $loggedInOperator->tenant->id;

        $record = static::getResource()::resolveMyRecordRouteBinding($key);

        if ($record === null) {
            throw (new ModelNotFoundException())->setModel($this->getModel(), [$key]);
        }

        return $record;
    }
}
