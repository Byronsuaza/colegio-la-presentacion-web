<?php

namespace App\Filament\Resources\GaleriaAlbums;

use App\Filament\Resources\GaleriaAlbums\Pages\CreateGaleriaAlbum;
use App\Filament\Resources\GaleriaAlbums\Pages\EditGaleriaAlbum;
use App\Filament\Resources\GaleriaAlbums\Pages\ListGaleriaAlbums;
use App\Filament\Resources\GaleriaAlbums\Schemas\GaleriaAlbumForm;
use App\Filament\Resources\GaleriaAlbums\Tables\GaleriaAlbumsTable;
use App\Models\GaleriaAlbum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GaleriaAlbumResource extends Resource
{
    protected static ?string $model = GaleriaAlbum::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Galería';

    protected static ?string $modelLabel = 'Álbum de galería';

    protected static ?string $pluralModelLabel = 'Galería';

    protected static ?string $recordTitleAttribute = 'titulo';

    public static function form(Schema $schema): Schema
    {
        return GaleriaAlbumForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GaleriaAlbumsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGaleriaAlbums::route('/'),
            'create' => CreateGaleriaAlbum::route('/create'),
            'edit' => EditGaleriaAlbum::route('/{record}/edit'),
        ];
    }
}
