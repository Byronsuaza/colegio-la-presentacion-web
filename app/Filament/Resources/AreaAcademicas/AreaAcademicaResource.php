<?php

namespace App\Filament\Resources\AreaAcademicas;

use App\Filament\Resources\AreaAcademicas\Pages\CreateAreaAcademica;
use App\Filament\Resources\AreaAcademicas\Pages\EditAreaAcademica;
use App\Filament\Resources\AreaAcademicas\Pages\ListAreaAcademicas;
use App\Filament\Resources\AreaAcademicas\Schemas\AreaAcademicaForm;
use App\Filament\Resources\AreaAcademicas\Tables\AreaAcademicasTable;
use App\Models\AreaAcademica;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AreaAcademicaResource extends Resource
{
    protected static ?string $model = AreaAcademica::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Comités Académicos';

    protected static ?string $modelLabel = 'Comité Académico';

    protected static ?string $pluralModelLabel = 'Comités Académicos';

    protected static ?string $recordTitleAttribute = 'titulo';

    public static function form(Schema $schema): Schema
    {
        return AreaAcademicaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AreaAcademicasTable::configure($table);
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
            'index' => ListAreaAcademicas::route('/'),
            'create' => CreateAreaAcademica::route('/create'),
            'edit' => EditAreaAcademica::route('/{record}/edit'),
        ];
    }
}
