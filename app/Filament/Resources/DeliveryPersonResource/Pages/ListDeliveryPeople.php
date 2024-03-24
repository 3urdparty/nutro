<?php

namespace App\Filament\Resources\DeliveryPersonResource\Pages;

use App\Filament\Resources\DeliveryPersonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeliveryPeople extends ListRecords
{
    protected static string $resource = DeliveryPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
