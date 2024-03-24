<?php

namespace App\Filament\Resources\DeliveryPersonResource\Pages;

use App\Filament\Resources\DeliveryPersonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryPerson extends EditRecord
{
    protected static string $resource = DeliveryPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
