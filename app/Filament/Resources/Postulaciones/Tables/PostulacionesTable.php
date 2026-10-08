<?php

namespace App\Filament\Resources\Postulaciones\Tables;

use App\Models\Postulacion;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostulacionesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('nombre_completo')
                    ->label('Postulante')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('cargo')
                    ->label('Cargo / vacante')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->copyable(),
                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Nueva' => 'warning',
                        'En revisión' => 'info',
                        'Preseleccionado' => 'primary',
                        'Contratado' => 'success',
                        'Descartado' => 'gray',
                        default => 'gray',
                    })
                    ->sortable()
                    ->label('Estado'),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y h:i A', 'America/Bogota')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options(Postulacion::ESTADOS),
                SelectFilter::make('cargo')
                    ->label('Cargo / vacante')
                    ->options(fn () => Postulacion::query()->distinct()->orderBy('cargo')->pluck('cargo', 'cargo')->all()),
            ])
            ->recordActions([
                Action::make('hojaVida')
                    ->label('Hoja de vida')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn (Postulacion $record) => route('postulaciones.hoja-vida', $record))
                    ->openUrlInNewTab(),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Aún no hay postulaciones')
            ->emptyStateDescription('Las hojas de vida enviadas desde "Trabaja con Nosotros" aparecerán aquí.');
    }
}
