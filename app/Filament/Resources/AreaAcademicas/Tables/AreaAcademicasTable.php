<?php

namespace App\Filament\Resources\AreaAcademicas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AreaAcademicasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->searchable()
                    ->sortable()
                    ->label('Área / Comité'),
                TextColumn::make('coordinador')
                    ->searchable()
                    ->sortable()
                    ->label('Coordinador(a)'),
                TextColumn::make('orden')
                    ->sortable()
                    ->label('Orden'),
                IconColumn::make('activa')
                    ->boolean()
                    ->label('Activa'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Última Actualización'),
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
