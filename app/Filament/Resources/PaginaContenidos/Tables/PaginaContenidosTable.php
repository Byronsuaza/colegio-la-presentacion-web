<?php

namespace App\Filament\Resources\PaginaContenidos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PaginaContenidosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Imagen'),
                TextColumn::make('titulo')
                    ->searchable()
                    ->sortable()
                    ->label('Título'),
                TextColumn::make('seccion')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->label('Sección'),
                TextColumn::make('url')
                    ->label('URL')
                    ->copyable(),
                TextColumn::make('url_externa')
                    ->label('URL externa')
                    ->limit(34)
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('publicada')
                    ->boolean()
                    ->label('Publicada'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Actualizada'),
            ])
            ->filters([
                SelectFilter::make('seccion')
                    ->options([
                        'Nuestra Institución' => 'Nuestra Institución',
                        'Gestión Académica' => 'Gestión Académica',
                        'Calidad y Pastoral' => 'Calidad y Pastoral',
                        'Gestión Comunitaria' => 'Gestión Comunitaria',
                        'Servicios y Comunidad' => 'Servicios y Comunidad',
                        'Comunicaciones & Contacto' => 'Comunicaciones & Contacto',
                        'Admisiones' => 'Admisiones',
                    ])
                    ->label('Sección'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('seccion');
    }
}
