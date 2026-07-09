<?php

namespace App\Filament\Resources\AreaAcademicas\Pages;

use App\Filament\Resources\AreaAcademicas\AreaAcademicaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAreaAcademica extends EditRecord
{
    protected static string $resource = AreaAcademicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
