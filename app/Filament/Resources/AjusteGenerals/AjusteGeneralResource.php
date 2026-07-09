<?php

namespace App\Filament\Resources\AjusteGenerals;

use App\Filament\Resources\AjusteGenerals\Pages\CreateAjusteGeneral;
use App\Filament\Resources\AjusteGenerals\Pages\EditAjusteGeneral;
use App\Filament\Resources\AjusteGenerals\Pages\ListAjusteGenerals;
use App\Filament\Resources\AjusteGenerals\Schemas\AjusteGeneralForm;
use App\Filament\Resources\AjusteGenerals\Tables\AjusteGeneralsTable;
use App\Models\AjusteGeneral;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AjusteGeneralResource extends Resource
{
    protected static ?string $model = AjusteGeneral::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Ajustes Generales';

    protected static ?string $modelLabel = 'Ajustes Generales';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return AjusteGeneralForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AjusteGeneralsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAjusteGenerals::route('/'),
            'create' => CreateAjusteGeneral::route('/create'),
            'edit' => EditAjusteGeneral::route('/{record}/edit'),
        ];
    }
}
