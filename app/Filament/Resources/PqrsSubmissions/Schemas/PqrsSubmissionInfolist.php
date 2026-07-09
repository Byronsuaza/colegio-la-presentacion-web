<?php

namespace App\Filament\Resources\PqrsSubmissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PqrsSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tipo'),
                TextEntry::make('nombre_completo'),
                TextEntry::make('tipo_documento'),
                TextEntry::make('documento'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('telefono'),
                TextEntry::make('relacion'),
                TextEntry::make('estudiante_nombre')
                    ->placeholder('-'),
                TextEntry::make('estudiante_grado')
                    ->placeholder('-'),
                TextEntry::make('mensaje')
                    ->columnSpanFull(),
                TextEntry::make('adjunto')
                    ->placeholder('-'),
                TextEntry::make('estado'),
                TextEntry::make('respuesta')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('respondido_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
