<?php

namespace App\Filament\Resources\AjusteGenerals\Pages;

use App\Filament\Resources\AjusteGenerals\AjusteGeneralResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAjusteGenerals extends ListRecords
{
    protected static string $resource = AjusteGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = \App\Models\AjusteGeneral::first();

        if ($record) {
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        }
    }
}
