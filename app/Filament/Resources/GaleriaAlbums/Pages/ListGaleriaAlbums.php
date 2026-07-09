<?php

namespace App\Filament\Resources\GaleriaAlbums\Pages;

use App\Filament\Resources\GaleriaAlbums\GaleriaAlbumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGaleriaAlbums extends ListRecords
{
    protected static string $resource = GaleriaAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
