<?php

namespace App\Filament\Resources\Noticias\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use App\Support\ImageOptimizer;

class NoticiaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required()
                    ->label('Título'),
                Select::make('categoria')
                    ->options([
                        'General' => 'General',
                        'Académico' => 'Académico',
                        'Deportes' => 'Deportes',
                        'Cultural' => 'Cultural',
                        'Pastoral' => 'Pastoral',
                    ])
                    ->required()
                    ->default('General')
                    ->label('Categoría'),
                ImageOptimizer::configure(FileUpload::make('imagen'), 'noticias')
                    ->label('Imagen destacada'),
                RichEditor::make('contenido')
                    ->required()
                    ->columnSpanFull()
                    ->label('Contenido completo'),
                Toggle::make('destacada')
                    ->default(false)
                    ->label('Noticia destacada (aparece en Bento Grid)'),
            ]);
    }
}
