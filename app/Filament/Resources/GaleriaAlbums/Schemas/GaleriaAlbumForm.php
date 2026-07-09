<?php

namespace App\Filament\Resources\GaleriaAlbums\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

use App\Support\ImageOptimizer;

class GaleriaAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del álbum')
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
                            ->label('Título'),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->label('Slug'),
                        TextInput::make('categoria')
                            ->required()
                            ->default('Actividades y Eventos')
                            ->maxLength(255)
                            ->label('Categoría'),
                        DatePicker::make('fecha')
                            ->label('Fecha del evento'),
                        TextInput::make('orden')
                            ->numeric()
                            ->default(0)
                            ->label('Orden'),
                        Toggle::make('publicado')
                            ->default(true)
                            ->label('Publicado'),
                        Textarea::make('descripcion')
                            ->rows(3)
                            ->columnSpanFull()
                            ->label('Descripción'),
                    ])
                    ->columns(2),

                Section::make('Imágenes')
                    ->compact()
                    ->description('La portada se usa para la tarjeta del álbum. Las imágenes conforman la galería interna.')
                    ->schema([
                        ImageOptimizer::configure(FileUpload::make('portada'), 'galeria/portadas')
                            ->label('Imagen de portada'),
                        ImageOptimizer::configure(FileUpload::make('imagenes'), 'galeria/imagenes')
                            ->multiple()
                            ->reorderable()
                            ->label('Imágenes del álbum')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Videos o enlaces')
                    ->compact()
                    ->schema([
                        Repeater::make('videos')
                            ->label('')
                            ->schema([
                                TextInput::make('label')
                                    ->required()
                                    ->label('Título'),
                                TextInput::make('url')
                                    ->required()
                                    ->url()
                                    ->label('URL'),
                            ])
                            ->columns(2)
                            ->addActionLabel('Agregar video/enlace')
                            ->collapsible()
                            ->collapsed()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
