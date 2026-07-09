<?php

namespace App\Filament\Resources\PqrsSubmissions\Pages;

use App\Filament\Resources\PqrsSubmissions\PqrsSubmissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPqrsSubmissions extends ListRecords
{
    protected static string $resource = PqrsSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
