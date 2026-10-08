<?php

namespace App\Filament\Resources\Postulaciones\Pages;

use App\Filament\Resources\Postulaciones\PostulacionResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPostulacion extends ViewRecord
{
    protected static string $resource = PostulacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('descargarHojaVida')
                ->label('Descargar hoja de vida')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(fn ($record) => route('postulaciones.hoja-vida', $record))
                ->openUrlInNewTab(),
            EditAction::make()
                ->label('Cambiar estado / notas'),
        ];
    }
}
