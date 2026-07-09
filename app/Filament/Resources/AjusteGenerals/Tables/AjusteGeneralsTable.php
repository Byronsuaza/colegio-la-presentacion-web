<?php

namespace App\Filament\Resources\AjusteGenerals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AjusteGeneralsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('telefono')
                    ->label('Teléfono'),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('direccion')
                    ->label('Dirección')
                    ->limit(50),
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
            ]);
    }
}
