<?php

namespace App\Filament\Resources\Postulaciones\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostulacionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos del Postulante')
                    ->compact()
                    ->schema([
                        TextEntry::make('nombre_completo')
                            ->label('Nombre completo')
                            ->weight('bold'),
                        TextEntry::make('cargo')
                            ->label('Cargo / vacante')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('telefono')
                            ->label('Número de contacto')
                            ->copyable(),
                        TextEntry::make('email')
                            ->label('Correo electrónico')
                            ->copyable()
                            ->url(fn ($record) => 'mailto:' . $record->email),
                        TextEntry::make('created_at')
                            ->label('Fecha de postulación')
                            ->dateTime('d/m/Y h:i A', 'America/Bogota'),
                        TextEntry::make('hoja_vida')
                            ->label('Hoja de vida')
                            ->formatStateUsing(fn () => 'Descargar hoja de vida ↓')
                            ->url(fn ($record) => route('postulaciones.hoja-vida', $record))
                            ->openUrlInNewTab()
                            ->color('warning'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Seguimiento')
                    ->compact()
                    ->schema([
                        TextEntry::make('estado')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Nueva' => 'warning',
                                'En revisión' => 'info',
                                'Preseleccionado' => 'primary',
                                'Contratado' => 'success',
                                'Descartado' => 'gray',
                                default => 'gray',
                            }),
                        TextEntry::make('notas')
                            ->label('Notas internas')
                            ->placeholder('Sin notas')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
