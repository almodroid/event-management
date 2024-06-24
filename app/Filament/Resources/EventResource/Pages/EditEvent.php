<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\EventOrganizerGate;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $eventOrganizerGatesData = $data['eventOrganizerGates'] ?? [];
        unset($data['eventOrganizerGates']);

        $event = $this->handleRecordUpdate($data);

        // حذف السجلات القديمة
        EventOrganizerGate::where('event_id', $event->id)->delete();

        // إضافة السجلات الجديدة
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