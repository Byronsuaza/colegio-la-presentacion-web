<?php

namespace App\Filament\Resources\Eventos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class EventoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Evento')
                    ->compact()
                    ->description('Gestiona la información del evento que se mostrará en el calendario.')
                    ->schema([
                        TextInput::make('titulo')
                            ->required()
                            ->maxLength(255)
                            ->label('Título del evento'),
                        DatePicker::make('fecha')
                            ->required()
                            ->label('Fecha del evento'),
                        TextInput::make('hora')
                            ->placeholder('Ej: 6:00 AM - 6:30 AM o Todo el día')
                            ->maxLength(255)
                            ->label('Hora / Duración'),
                        TextInput::make('lugar')
                            ->placeholder('Ej: Sala de Conferencias, Patio Principal')
                            ->maxLength(255)
                            ->label('Lugar'),
                        Toggle::make('es_activo')
                            ->label('Activo (Mostrar en la web)')
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}
