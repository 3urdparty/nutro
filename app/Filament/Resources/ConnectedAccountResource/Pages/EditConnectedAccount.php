<?php

namespace App\Filament\Resources\ConnectedAccountResource\Pages;

use App\Filament\Resources\ConnectedAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConnectedAccount extends EditRecord
{
    protected static string $resource = ConnectedAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
