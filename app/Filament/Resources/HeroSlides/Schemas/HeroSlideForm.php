<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use App\Support\ImageOptimizer;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título'),
                TextInput::make('subtitulo')
                    ->label('Subtítulo'),
                ImageOptimizer::configure(FileUpload::make('imagen'), 'hero_slides')
                    ->required()
                    ->label('Imagen'),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Orden'),
                Toggle::make('activo')
                    ->default(true)
                    ->label('Activo')
                    ->required(),
            ]);
    }
}
