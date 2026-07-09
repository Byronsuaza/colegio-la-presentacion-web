<?php

namespace App\Filament\Resources\Seccions\Pages;

use App\Filament\Resources\Seccions\SeccionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSeccion extends ViewRecord
{
    protected static string $resource = SeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
