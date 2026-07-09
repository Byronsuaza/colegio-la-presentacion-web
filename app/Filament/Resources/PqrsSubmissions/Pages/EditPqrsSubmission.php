<?php

namespace App\Filament\Resources\PqrsSubmissions\Pages;

use App\Filament\Resources\PqrsSubmissions\PqrsSubmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPqrsSubmission extends EditRecord
{
    protected static string $resource = PqrsSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
