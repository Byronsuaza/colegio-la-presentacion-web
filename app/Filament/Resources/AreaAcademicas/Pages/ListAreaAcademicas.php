<?php

namespace App\Filament\Resources\AreaAcademicas\Pages;

use App\Filament\Resources\AreaAcademicas\AreaAcademicaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAreaAcademicas extends ListRecords
{
    protected static string $resource = AreaAcademicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
