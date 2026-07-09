<?php

namespace App\Filament\Resources\AjusteGenerals\Pages;

use App\Filament\Resources\AjusteGenerals\AjusteGeneralResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAjusteGeneral extends EditRecord
{
    protected static string $resource = AjusteGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
