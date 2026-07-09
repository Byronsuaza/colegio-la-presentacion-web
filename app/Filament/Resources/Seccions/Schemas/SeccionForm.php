<?php

namespace App\Filament\Resources\Seccions\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

use App\Support\ImageOptimizer;

class SeccionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ── Fila 1: Información General (ocupa las 2 columnas) ──
                Section::make('Información General')
                    ->compact()
                    ->schema([
                        Select::make('nombre')
                            ->label('Nombre de la Sección')
                            ->options([
                                'preescolar'  => 'Preescolar',
                                'primaria'    => 'Primaria',
                                'bachillerato' => 'Bachillerato',
                            ])
                            ->required()
                            ->disabled(fn ($record) => $record !== null),

                        TextInput::make('titulo')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('descripcion_corta')
                            ->label('Descripción Corta')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),

                        Textarea::make('descripcion_completa')
                            ->label('Descripción Completa')
                            ->rows(3)
                            ->columnSpanFull(),

                        ImageOptimizer::configure(FileUpload::make('imagen_hero'), 'secciones')
                            ->label('Imagen del Hero')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Fila 2: Objetivos | Características (lado a lado) ──
                Grid::make(2)
                    ->schema([
                        Section::make('Objetivos')
                            ->compact()
                            ->schema([
                                Repeater::make('objetivos')
                                    ->label('')
                                    ->schema([
                                        TextInput::make('titulo')
                                            ->label('Título del Objetivo')
                                            ->required()
                                            ->columnSpanFull(),
                                        Textarea::make('descripcion')
                                            ->label('Descripción')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(1)
                                    ->addActionLabel('Agregar objetivo')
                                    ->collapsible()
                                    ->collapsed(),
                            ]),

                        Section::make('Características')
                            ->compact()
                            ->schema([
                                Repeater::make('caracteristicas')
                                    ->label('')
                                    ->schema([
                                        TextInput::make('titulo')
                                            ->label('Título')
                                            ->required()
                                            ->columnSpan(1),
                                        Select::make('icon')
                                            ->label('Icono')
                                            ->options([
                                                'graduation-cap' => 'Graduación',
                                                'heart'          => 'Corazón',
                                                'globe'          => 'Globo',
                                                'music'          => 'Música',
                                                'activity'       => 'Actividad',
                                                'sparkles'       => 'Destello',
                                                'glasses'        => 'Gafas',
                                                'beaker'         => 'Beaker',
                                                'target'         => 'Objetivo',
                                                'check-circle'   => 'Check',
                                                'briefcase'      => 'Maletín',
                                                'search'         => 'Búsqueda',
                                            ])
                                            ->required()
                                            ->columnSpan(1),
                                        Textarea::make('descripcion')
                                            ->label('Descripción')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar característica')
                                    ->collapsible()
                                    ->collapsed(),
                            ]),
                    ])
                    ->columnSpanFull(),

                // ── Fila 3: Programas | Grados (lado a lado) ──
                Grid::make(2)
                    ->schema([
                        Section::make('Programas')
                            ->compact()
                            ->schema([
                                Repeater::make('programas')
                                    ->label('')
                                    ->schema([
                                        TextInput::make('nombre')
                                            ->label('Nombre del Programa')
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(1)
                                    ->addActionLabel('Agregar programa')
                                    ->collapsible()
                                    ->collapsed(),
                            ]),

                        Section::make('Grados')
                            ->compact()
                            ->schema([
                                Repeater::make('grados')
                                    ->label('')
                                    ->schema([
                                        TextInput::make('nombre')
                                            ->label('Nombre del Grado')
                                            ->required()
                                            ->columnSpan(1),
                                        TextInput::make('edades')
                                            ->label('Edades')
                                            ->required()
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar grado')
                                    ->collapsible()
                                    ->collapsed(),
                            ]),
                    ])
                    ->columnSpanFull(),

                // ── Fila 4: Estadísticas | Coordinador (lado a lado) ──
                Grid::make(2)
                    ->schema([
                        Section::make('Estadísticas')
                            ->compact()
                            ->schema([
                                KeyValue::make('estadisticas')
                                    ->label('')
                                    ->keyLabel('Concepto')
                                    ->valueLabel('Valor'),
                            ]),

                        Section::make('Coordinador')
                            ->compact()
                            ->schema([
                                TextInput::make('coordinador_nombre')
                                    ->label('Nombre')
                                    ->columnSpanFull(),
                                TextInput::make('coordinador_correo')
                                    ->label('Correo')
                                    ->email()
                                    ->columnSpanFull(),
                                TextInput::make('coordinador_telefono')
                                    ->label('Teléfono')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1),
                    ])
                    ->columnSpanFull(),

                // ── Fila 5: Galería (ancho completo) ──
                Section::make('Galería')
                    ->compact()
                    ->schema([
                        Repeater::make('galeria')
                            ->label('')
                            ->schema([
                                ImageOptimizer::configure(FileUpload::make('url'), 'secciones/galeria')
                                    ->label('Imagen')
                                    ->required()
                                    ->columnSpan(1),
                                TextInput::make('titulo')
                                    ->label('Título de la Imagen')
                                    ->required()
                                    ->columnSpan(1),
                            ])
                            ->columns(2)
                            ->addActionLabel('Agregar imagen')
                            ->collapsible()
                            ->collapsed(),
                    ])
                    ->columnSpanFull(),

            ]);
    }
}
