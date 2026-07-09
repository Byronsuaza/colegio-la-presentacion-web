<?php

namespace App\Filament\Resources\GaleriaAlbums\Pages;

use App\Filament\Resources\GaleriaAlbums\GaleriaAlbumResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGaleriaAlbum extends EditRecord
{
    protected static string $resource = GaleriaAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
