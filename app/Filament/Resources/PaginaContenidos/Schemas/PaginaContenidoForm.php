<?php

namespace App\Filament\Resources\PaginaContenidos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

use App\Support\ImageOptimizer;

class PaginaContenidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ── Layout principal: columna izquierda ancha + columna derecha ──
                Grid::make(3)
                    ->schema([

                        // ── Columna izquierda (2/3) ──
                        Grid::make(1)
                            ->schema([

                                Section::make('Identificación')
                                    ->compact()
                                    ->description('Ubicación de esta página dentro del menú.')
                                    ->schema([
                                        Select::make('seccion')
                                            ->label('Sección')
                                            ->options([
                                                'Nuestra Institución'      => 'Nuestra Institución',
                                                'Gestión Académica'        => 'Gestión Académica',
                                                'Calidad y Pastoral'       => 'Calidad y Pastoral',
                                                'Gestión Comunitaria'      => 'Gestión Comunitaria',
                                                'Servicios y Comunidad'    => 'Servicios y Comunidad',
                                                'Comunicaciones & Contacto' => 'Comunicaciones & Contacto',
                                                'Admisiones'               => 'Admisiones',
                                            ])
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function ($state, $set) {
                                                $bases = [
                                                    'Nuestra Institución'      => 'nuestra-institucion',
                                                    'Gestión Académica'        => 'gestion-academica',
                                                    'Calidad y Pastoral'       => 'calidad-y-pastoral',
                                                    'Gestión Comunitaria'      => 'gestion-comunitaria',
                                                    'Servicios y Comunidad'    => 'servicios',
                                                    'Comunicaciones & Contacto' => 'comunicaciones-contacto',
                                                    'Admisiones'               => 'admisiones',
                                                ];
                                                if (isset($bases[$state])) {
                                                    $set('base', $bases[$state]);
                                                }
                                            })
                                            ->columnSpan(1),

                                        Select::make('subseccion')
                                            ->label('Sub-apartado')
                                            ->helperText('Sub-menú donde aparecerá. Sin selección → "Más".')
                                            ->options(function (callable $get) {
                                                $seccion = $get('seccion');
                                                if (! $seccion) {
                                                    return [];
                                                }
                                                $options = [
                                                    'Nuestra Institución' => [
                                                        'Identidad'          => 'Identidad',
                                                        'Gobierno y memoria' => 'Gobierno y memoria',
                                                        'Recursos'           => 'Recursos',
                                                    ],
                                                    'Gestión Académica' => [
                                                        'Planeación'           => 'Planeación',
                                                        'Horarios específicos' => 'Horarios específicos',
                                                        'Seguimiento'          => 'Seguimiento',
                                                    ],
                                                    'Calidad y Pastoral' => [
                                                        'Calidad'  => 'Calidad',
                                                        'Pastoral' => 'Pastoral',
                                                    ],
                                                    'Gestión Comunitaria' => [
                                                        'Convivencia'        => 'Convivencia',
                                                        'Rutas de atención'  => 'Rutas de atención',
                                                        'Kit de herramientas' => 'Kit de herramientas',
                                                        'Proyectos'          => 'Proyectos',
                                                    ],
                                                    'Servicios y Comunidad' => [
                                                        'Plataformas'        => 'Plataformas',
                                                        'Comunidad educativa' => 'Comunidad educativa',
                                                    ],
                                                    'Comunicaciones & Contacto' => [
                                                        'Comunicaciones' => 'Comunicaciones',
                                                    ],
                                                    'Admisiones' => [
                                                        'Admisiones' => 'Admisiones',
                                                    ],
                                                ];

                                                return $options[$seccion] ?? [];
                                            })
                                            ->columnSpan(1),

                                        TextInput::make('base')
                                            ->required()
                                            ->maxLength(255)
                                            ->label('Base URL')
                                            ->helperText('Ej: nuestra-institucion')
                                            ->columnSpan(1),

                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->label('Slug')
                                            ->helperText('Ej: mision')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Section::make('Contenido')
                                    ->compact()
                                    ->schema([
                                        TextInput::make('titulo')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, $state, $set, $get): void {
                                                if ($operation !== 'create' || filled($get('slug'))) {
                                                    return;
                                                }
                                                $set('slug', Str::slug($state));
                                            })
                                            ->label('Título')
                                            ->columnSpan(1),

                                        TextInput::make('subtitulo')
                                            ->maxLength(255)
                                            ->label('Subtítulo / resumen')
                                            ->columnSpan(1),

                                        RichEditor::make('contenido')
                                            ->columnSpanFull()
                                            ->label('Contenido de la página'),
                                    ])
                                    ->columns(2),

                                Section::make('Enlaces y documentos')
                                    ->compact()
                                    ->description('PDFs, Drive, formularios o recursos externos.')
                                    ->schema([
                                        Repeater::make('enlaces')
                                            ->label('')
                                            ->schema([
                                                TextInput::make('label')
                                                    ->required()
                                                    ->label('Texto del enlace')
                                                    ->columnSpan(1),
                                                TextInput::make('url')
                                                    ->label('URL')
                                                    ->columnSpan(1),
                                                FileUpload::make('archivo')
                                                    ->acceptedFileTypes(['application/pdf'])
                                                    ->directory('documentos')
                                                    ->label('PDF')
                                                    ->columnSpanFull(),
                                            ])
                                            ->columns(2)
                                            ->addActionLabel('Agregar enlace')
                                            ->collapsible()
                                            ->collapsed()
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpan(2),

                        // ── Columna derecha (1/3) ──
                        Grid::make(1)
                            ->schema([
                                Section::make('Publicación')
                                    ->compact()
                                    ->schema([
                                        Toggle::make('publicada')
                                            ->default(true)
                                            ->label('Publicada')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Imagen destacada')
                                    ->compact()
                                    ->schema([
                                        ImageOptimizer::configure(FileUpload::make('imagen'), 'paginas')
                                            ->label('')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('URL Externa')
                                    ->compact()
                                    ->description('Si se llena, el menú redirige aquí en lugar de abrir la página interna.')
                                    ->schema([
                                        TextInput::make('url_externa')
                                            ->url()
                                            ->maxLength(255)
                                            ->label('')
                                            ->placeholder('https://...')
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpan(1),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
