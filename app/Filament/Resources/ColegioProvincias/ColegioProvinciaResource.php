<?php

namespace App\Filament\Resources\ColegioProvincias;

use App\Filament\Resources\ColegioProvincias\Pages\CreateColegioProvincia;
use App\Filament\Resources\ColegioProvincias\Pages\EditColegioProvincia;
use App\Filament\Resources\ColegioProvincias\Pages\ListColegioProvincias;
use App\Filament\Resources\ColegioProvincias\Schemas\ColegioProvinciaForm;
use App\Filament\Resources\ColegioProvincias\Tables\ColegioProvinciasTable;
use App\Models\ColegioProvincia;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ColegioProvinciaResource extends Resource
{
    protected static ?string $model = ColegioProvincia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static ?string $navigationLabel = 'Colegios de la Provincia';

    protected static ?string $modelLabel = 'Colegio de la Provincia';

    protected static ?string $pluralModelLabel = 'Colegios de la Provincia';

    protected static ?string $recordTitleAttribute = 'nombre';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return ColegioProvinciaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ColegioProvinciasTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListColegioProvincias::route('/'),
            'create' => CreateColegioProvincia::route('/create'),
            'edit' => EditColegioProvincia::route('/{record}/edit'),
        ];
    }
}
