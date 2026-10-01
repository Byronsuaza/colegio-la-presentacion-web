<?php

namespace App\Filament\Resources\ColegioProvincias\Pages;

use App\Filament\Resources\ColegioProvincias\ColegioProvinciaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditColegioProvincia extends EditRecord
{
    protected static string $resource = ColegioProvinciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
