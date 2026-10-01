<?php

namespace App\Filament\Resources\ColegioProvincias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ColegioProvinciasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->height(40),
                TextColumn::make('nombre')
                    ->label('Colegio')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('ciudad')
                    ->label('Ciudad')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('url')
                    ->label('Sitio Web')
                    ->limit(35)
                    ->url(fn ($record) => $record->url, true),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
                IconColumn::make('activo')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->defaultSort('orden', 'asc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
