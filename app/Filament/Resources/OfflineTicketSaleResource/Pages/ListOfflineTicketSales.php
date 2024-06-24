<?php

namespace App\Filament\Resources\OfflineTicketSaleResource\Pages;

use App\Filament\Resources\OfflineTicketSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfflineTicketSales extends ListRecords
{
    protected static string $resource = OfflineTicketSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
