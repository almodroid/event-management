<?php

namespace App\Filament\Resources\OrganizerResource\Pages;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

use App\Filament\Resources\OrganizerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganizer extends CreateRecord
{
    protected static string $resource = OrganizerResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure QR code is generated before saving
        $data['qr_code'] = base64_encode(QrCode::format('png')->size(200)->generate(Str::random(10)));
        return $data;
    }
}
