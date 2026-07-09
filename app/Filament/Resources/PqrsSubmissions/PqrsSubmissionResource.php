<?php

namespace App\Filament\Resources\PqrsSubmissions;

use App\Filament\Resources\PqrsSubmissions\Pages\CreatePqrsSubmission;
use App\Filament\Resources\PqrsSubmissions\Pages\EditPqrsSubmission;
use App\Filament\Resources\PqrsSubmissions\Pages\ListPqrsSubmissions;
use App\Filament\Resources\PqrsSubmissions\Pages\ViewPqrsSubmission;
use App\Filament\Resources\PqrsSubmissions\Schemas\PqrsSubmissionForm;
use App\Filament\Resources\PqrsSubmissions\Schemas\PqrsSubmissionInfolist;
use App\Filament\Resources\PqrsSubmissions\Tables\PqrsSubmissionsTable;
use App\Models\PqrsSubmission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PqrsSubmissionResource extends Resource
{
    protected static ?string $model = PqrsSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxStack;

    protected static ?string $navigationLabel = 'Buzón PQRS';

    protected static ?string $modelLabel = 'PQRS';

    protected static ?string $pluralModelLabel = 'Buzón PQRS';

    protected static ?string $recordTitleAttribute = 'nombre_completo';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return PqrsSubmissionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PqrsSubmissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PqrsSubmissionsTable::configure($table);
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
            'index' => ListPqrsSubmissions::route('/'),
            'create' => CreatePqrsSubmission::route('/create'),
            'view' => ViewPqrsSubmission::route('/{record}'),
            'edit' => EditPqrsSubmission::route('/{record}/edit'),
        ];
    }
}
