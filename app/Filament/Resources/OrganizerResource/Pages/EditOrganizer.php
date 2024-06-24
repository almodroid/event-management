<?php

namespace App\Filament\Resources\OrganizerResource\Pages;

use App\Filament\Resources\OrganizerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganizer extends EditRecord
{
    protected static string $resource = OrganizerResource::class;
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // إذا لم يتم إدخال كلمة المرور، أزل الحقل من البيانات ليبقى الحقل كما هو في قاعدة البيانات
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            // في حالة إدخال كلمة مرور جديدة، قم بتشفيرها
            $data['password'] = bcrypt($data['password']);
        }

        return $data;
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
