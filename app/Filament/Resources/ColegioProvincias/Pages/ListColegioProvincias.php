<?php

namespace App\Filament\Resources\ColegioProvincias\Pages;

use App\Filament\Resources\ColegioProvincias\ColegioProvinciaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListColegioProvincias extends ListRecords
{
    protected static string $resource = ColegioProvinciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nuevo Colegio'),
        ];
    }
}
