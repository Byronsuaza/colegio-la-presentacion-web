<?php

namespace App\Filament\Resources\AjusteGenerals\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class AjusteGeneralForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ── Fila 1: Contacto y Redes Sociales (lado a lado) ──
                Grid::make(2)
                    ->schema([
                        Section::make('Contacto')
                            ->description('Información de contacto principal.')
                            ->compact()
                            ->schema([
                                TextInput::make('telefono')
                                    ->tel()
                                    ->maxLength(255),
                                TextInput::make('direccion')
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                            ])->columns(1),

                        Section::make('Redes Sociales')
                            ->description('Enlaces a las redes sociales del colegio.')
                            ->compact()
                            ->schema([
                                TextInput::make('facebook')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('instagram')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('whatsapp')
                                    ->url()
                                    ->maxLength(255),
                            ])->columns(1),
                    ])
                    ->columnSpanFull(),

                // ── Fila 2: Admisiones (ancho completo) ──
                Section::make('Admisiones')
                    ->description('Textos globales de la campaña de admisiones. Actualiza el año aquí y se reflejará en el sitio.')
                    ->compact()
                    ->schema([
                        TextInput::make('admisiones_anio')
                            ->required()
                            ->maxLength(10)
                            ->label('Año de admisiones'),
                        TextInput::make('admisiones_titulo')
                            ->maxLength(255)
                            ->label('Título'),
                        Textarea::make('admisiones_descripcion')
                            ->rows(3)
                            ->columnSpanFull()
                            ->label('Descripción'),
                        TextInput::make('admisiones_boton_texto')
                            ->required()
                            ->maxLength(255)
                            ->label('Texto del botón principal'),
                        TextInput::make('admisiones_boton_url')
                            ->required()
                            ->maxLength(255)
                            ->label('URL del botón principal'),
                        TextInput::make('admisiones_llamada_texto')
                            ->maxLength(255)
                            ->label('Texto del botón de llamada'),
                    ])->columns(2)
                    ->columnSpanFull(),

                // ── Fila 3: Pastoral y Pagos (lado a lado) ──
                Grid::make(2)
                    ->schema([
                        Section::make('Pastoral / Evangelio')
                            ->description('Configuración del Evangelio semanal de la institución.')
                            ->compact()
                            ->schema([
                                TextInput::make('evangelio_embed_url')
                                    ->url()
                                    ->columnSpanFull()
                                    ->label('Enlace de presentación de Canva'),
                            ]),

                        Section::make('Pagos y Plataformas')
                            ->description('URLs de acceso rápido en la página principal.')
                            ->compact()
                            ->schema([
                                TextInput::make('pago_en_linea_url')
                                    ->url()
                                    ->columnSpanFull()
                                    ->placeholder('https://...')
                                    ->label('URL de Pago en Línea (PSE)')
                                    ->helperText('Enlace directo al portal PSE o botón de pago.'),
                                TextInput::make('syscolegios_url')
                                    ->url()
                                    ->columnSpanFull()
                                    ->placeholder('https://syscolegios.com/...')
                                    ->label('URL Portal Syscolegios')
                                    ->helperText('Enlace directo al portal de Syscolegios.'),
                            ]),
                    ])
                    ->columnSpanFull(),

                // ── Fila 4: Pruebas Diagnósticas (acceso con contraseña) ──
                Section::make('Pruebas Diagnósticas')
                    ->description('Protege la página de Pruebas Diagnósticas con una contraseña. Déjalo vacío para que la página sea pública.')
                    ->compact()
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        TextInput::make('pruebas_diagnosticas_password')
                            ->label('Contraseña de acceso')
                            ->password()
                            ->revealable()
                            ->nullable()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->helperText('Si está vacío, cualquier visitante puede acceder. Si tiene una contraseña, se mostrará una pantalla de bloqueo.'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
