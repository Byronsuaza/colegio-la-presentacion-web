<?php

namespace App\Filament\Resources\PqrsSubmissions\Pages;

use App\Filament\Resources\PqrsSubmissions\PqrsSubmissionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPqrsSubmission extends ViewRecord
{
    protected static string $resource = PqrsSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
