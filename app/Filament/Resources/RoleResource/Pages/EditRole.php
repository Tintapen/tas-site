<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function afterSave(): void
    {
        $permissions = $this->form->getState()['permissions_state'] ?? [];

        // Pastikan permissions dalam bentuk array
        if (is_string($permissions)) {
            $decoded = json_decode($permissions, true);
            $permissions = is_array($decoded) ? $decoded : [];
        }

        // Filter supaya isinya hanya string permission
        $permissions = array_filter($permissions, fn ($perm) => is_string($perm));

        $this->record->syncPermissions($permissions);
    }
}
