<?php

namespace App\Filament\Resources\PqrsSubmissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class PqrsSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('tipo')
                    ->badge()
                    ->sortable()
                    ->label('Tipo'),
                TextColumn::make('nombre_completo')
                    ->searchable()
                    ->sortable()
                    ->label('Solicitante'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Correo'),
                TextColumn::make('telefono')
                    ->label('Teléfono'),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pendiente' => 'danger',
                        'En revisión' => 'warning',
                        'Respondido' => 'success',
                        'Archivado' => 'gray',
                        default => 'gray',
                    })
                    ->sortable()
                    ->label('Estado'),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y h:i A')
                    ->sortable()
                    ->label('Fecha de Ingreso'),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'En revisión' => 'En revisión',
                        'Respondido' => 'Respondido',
                        'Archivado' => 'Archivado',
                    ])
                    ->label('Estado'),
                SelectFilter::make('tipo')
                    ->options([
                        'Petición' => 'Petición',
                        'Queja' => 'Queja',
                        'Reclamo' => 'Reclamo',
                        'Sugerencia' => 'Sugerencia',
                        'Felicitación' => 'Felicitación',
                    ])
                    ->label('Tipo de Solicitud'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
