<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\EventOrganizerGate;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $eventOrganizerGatesData = $data['eventOrganizerGates'] ?? [];
        unset($data['eventOrganizerGates']);

        $event = $this->handleRecordCreation($data);

        foreach ($eventOrganizerGatesData as $organizerGateData) {
            $eventOrganizerGate = new EventOrganizerGate([
                'organizer_id' => $organizerGateData['organizer_id'],
                'gate_name' => $organizerGateData['gate_name'],
            ]);
            $eventOrganizerGate->event()->associate($event);
            $eventOrganizerGate->save();
        }

        return $data;
    }
}