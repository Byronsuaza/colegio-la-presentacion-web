<?php

namespace App\Filament\Resources\GaleriaAlbums\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GaleriaAlbumsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('portada')
                    ->label('Portada'),
                TextColumn::make('titulo')
                    ->searchable()
                    ->sortable()
                    ->label('Álbum'),
                TextColumn::make('categoria')
                    ->badge()
                    ->searchable()
                    ->label('Categoría'),
                TextColumn::make('fecha')
                    ->date()
                    ->sortable()
                    ->label('Fecha'),
                TextColumn::make('orden')
                    ->sortable()
                    ->label('Orden'),
                IconColumn::make('publicado')
                    ->boolean()
                    ->label('Publicado'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Actualizado'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('orden');
    }
}
