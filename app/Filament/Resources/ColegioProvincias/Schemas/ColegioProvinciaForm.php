<?php

namespace App\Filament\Resources\ColegioProvincias\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ColegioProvinciaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre del Colegio')
                    ->required()
                    ->placeholder('Ej: Colegio de La Presentación Neiva'),
                TextInput::make('ciudad')
                    ->label('Ciudad / Municipio')
                    ->placeholder('Ej: Neiva'),
                TextInput::make('url')
                    ->label('Sitio Web Oficial (URL)')
                    ->required()
                    ->url()
                    ->placeholder('https://ejemplo.edu.co'),
                FileUpload::make('logo')
                    ->label('Logo del Colegio')
                    ->disk('public')
                    ->directory('colegios_provincia')
                    ->image()
                    ->required(),
                TextInput::make('orden')
                    ->label('Orden de visualización')
                    ->numeric()
                    ->default(0),
                Toggle::make('activo')
                    ->label('Visible en la página web')
                    ->default(true),
            ]);
    }
}
