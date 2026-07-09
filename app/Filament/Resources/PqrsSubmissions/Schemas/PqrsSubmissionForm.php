<?php

namespace App\Filament\Resources\PqrsSubmissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PqrsSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Estado del Trámite')
                    ->compact()
                    ->schema([
                        TextInput::make('tipo')
                            ->disabled()
                            ->label('Tipo de Solicitud'),
                        Select::make('estado')
                            ->options([
                                'Pendiente' => 'Pendiente',
                                'En revisión' => 'En revisión',
                                'Respondido' => 'Respondido',
                                'Archivado' => 'Archivado',
                            ])
                            ->required()
                            ->label('Estado actual del PQRS'),
                    ])->columns(2),

                Section::make('Datos del Solicitante')
                    ->compact()
                    ->schema([
                        TextInput::make('nombre_completo')
                            ->disabled()
                            ->label('Nombre Completo'),
                        TextInput::make('tipo_documento')
                            ->disabled()
                            ->label('Tipo de Documento'),
                        TextInput::make('documento')
                            ->disabled()
                            ->label('Número de Documento'),
                        TextInput::make('email')
                            ->disabled()
                            ->email()
                            ->label('Correo Electrónico'),
                        TextInput::make('telefono')
                            ->disabled()
                            ->label('Teléfono / Celular'),
                        TextInput::make('relacion')
                            ->disabled()
                            ->label('Relación con la Institución'),
                    ])->columns(3),

                Section::make('Datos del Estudiante (Si aplica)')
                    ->compact()
                    ->schema([
                        TextInput::make('estudiante_nombre')
                            ->disabled()
                            ->label('Nombre del Estudiante'),
                        TextInput::make('estudiante_grado')
                            ->disabled()
                            ->label('Grado'),
                    ])->columns(2),

                Section::make('Detalle del Mensaje')
                    ->compact()
                    ->schema([
                        Textarea::make('mensaje')
                            ->disabled()
                            ->rows(5)
                            ->columnSpanFull()
                            ->label('Mensaje / Petición'),

                        Placeholder::make('archivo_adjunto')
                            ->label('Archivo Adjunto')
                            ->content(function ($record) {
                                if (!$record || !$record->adjunto) {
                                    return 'Ninguno';
                                }
                                $url = route('pqrs.attachment', $record);
                                return new \Illuminate\Support\HtmlString("<a href='{$url}' target='_blank' style='color: #d4af37; font-weight: bold; text-decoration: underline;'>Ver archivo adjunto ↗</a>");
                            }),
                    ]),

                Section::make('Respuesta y Notas de Seguimiento')
                    ->compact()
                    ->schema([
                        Textarea::make('respuesta')
                            ->rows(4)
                            ->columnSpanFull()
                            ->label('Respuesta / Notas de Seguimiento')
                            ->helperText('Escribe aquí la respuesta formal enviada al solicitante o notas de control interno.'),
                    ]),
            ]);
    }
}
