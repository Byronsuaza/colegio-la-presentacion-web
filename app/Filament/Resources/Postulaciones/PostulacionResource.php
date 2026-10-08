<?php

namespace App\Filament\Resources\Postulaciones;

use App\Filament\Resources\Postulaciones\Pages\EditPostulacion;
use App\Filament\Resources\Postulaciones\Pages\ListPostulaciones;
use App\Filament\Resources\Postulaciones\Pages\ViewPostulacion;
use App\Filament\Resources\Postulaciones\Schemas\PostulacionForm;
use App\Filament\Resources\Postulaciones\Schemas\PostulacionInfolist;
use App\Filament\Resources\Postulaciones\Tables\PostulacionesTable;
use App\Models\Postulacion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PostulacionResource extends Resource
{
    protected static ?string $model = Postulacion::class;

    protected static ?string $slug = 'postulaciones';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?string $navigationLabel = 'Postulaciones';

    protected static ?string $modelLabel = 'Postulación';

    protected static ?string $pluralModelLabel = 'Postulaciones (Talento Humano)';

    protected static ?string $recordTitleAttribute = 'nombre_completo';

    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * Muestra en el menú lateral cuántas postulaciones nuevas hay sin revisar.
     */
    public static function getNavigationBadge(): ?string
    {
        try {
            if (! \Illuminate\Support\Facades\Schema::hasTable('postulaciones')) {
                return null;
            }

            $nuevas = static::getModel()::where('estado', 'Nueva')->count();

            return $nuevas > 0 ? (string) $nuevas : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return PostulacionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PostulacionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostulacionesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPostulaciones::route('/'),
            'view' => ViewPostulacion::route('/{record}'),
            'edit' => EditPostulacion::route('/{record}/edit'),
        ];
    }
}
