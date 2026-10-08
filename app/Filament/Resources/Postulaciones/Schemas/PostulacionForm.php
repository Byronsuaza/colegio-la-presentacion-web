<?php

namespace App\Filament\Resources\Postulaciones\Schemas;

use App\Models\Postulacion;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class PostulacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos del Postulante')
                    ->compact()
                    ->schema([
                        TextInput::make('nombre_completo')
                            ->label('Nombre completo')
                            ->disabled(),
                        TextInput::make('telefono')
                            ->label('Número de contacto')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->disabled(),
                        TextInput::make('cargo')
                            ->label('Cargo / vacante')
                            ->disabled(),
                        Placeholder::make('hoja_vida_link')
                            ->label('Hoja de vida')
                            ->content(function ($record) {
                                if (! $record || ! $record->hoja_vida) {
                                    return 'No adjunta';
                                }
                                $url = e(route('postulaciones.hoja-vida', $record));

                                return new HtmlString("<a href='{$url}' target='_blank' style='color: #d4af37; font-weight: bold; text-decoration: underline;'>Descargar hoja de vida ↓</a>");
                            }),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Seguimiento (uso interno)')
                    ->compact()
                    ->schema([
                        Select::make('estado')
                            ->label('Estado del proceso')
                            ->options(Postulacion::ESTADOS)
                            ->required(),
                        Textarea::make('notas')
                            ->label('Notas internas')
                            ->rows(4)
                            ->helperText('Observaciones de la entrevista, fecha de contacto, etc. No se envían al postulante.')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
