<?php

namespace App\Filament\Resources\AreaAcademicas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class AreaAcademicaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Comité')
                    ->description('Datos generales de la área académica o comité.')
                    ->compact()
                    ->schema([
                        TextInput::make('titulo')
                            ->required()
                            ->maxLength(255)
                            ->label('Título de la Área / Comité')
                            ->placeholder('Ejemplo: Área de Matemáticas'),
                        TextInput::make('coordinador')
                            ->maxLength(255)
                            ->label('Jefe de Área')
                            ->placeholder('Nombre del docente Jefe de Área'),
                        RichEditor::make('descripcion')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'orderedList',
                                'redo',
                                'undo',
                                'h1',
                                'h2',
                                'h3',
                            ])
                            ->label('Integrantes del Comité')
                            ->helperText('Usa la lista con viñetas para agregar a los docentes integrantes del comité.'),
                        TextInput::make('orden')
                            ->numeric()
                            ->default(0)
                            ->label('Orden de visualización')
                            ->helperText('Define el orden en el que aparecerá en la página (menor número aparece primero).'),
                        Toggle::make('activa')
                            ->default(true)
                            ->label('Activa')
                            ->helperText('Si se desmarca, no aparecerá en el sitio web.'),
                    ])
                    ->columns(2),

                Section::make('Documentos y Recursos')
                    ->description('Lista de documentos descargables, PDFs o enlaces externos de interés para este comité.')
                    ->compact()
                    ->schema([
                        Repeater::make('enlaces')
                            ->schema([
                                TextInput::make('titulo')
                                    ->required()
                                    ->label('Nombre del Documento / Enlace')
                                    ->placeholder('Ejemplo: Plan de área 2026'),
                                TextInput::make('url')
                                    ->label('URL Externa')
                                    ->placeholder('https://drive.google.com/...')
                                    ->helperText('Enlace a Google Drive, formulario u otro sitio externo.'),
                                FileUpload::make('archivo')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('documentos')
                                    ->label('O subir un archivo PDF')
                                    ->helperText('Si subes un PDF aquí, el sistema lo usará de forma prioritaria.'),
                            ])
                            ->columns(3)
                            ->addActionLabel('Agregar documento o enlace')
                            ->collapsible()
                            ->collapsed()
                            ->columnSpanFull()
                            ->label('Recursos descargables'),
                    ]),
            ]);
    }
}
