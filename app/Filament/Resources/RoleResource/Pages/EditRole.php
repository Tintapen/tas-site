<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function afterSave(): void
    {
        $permissions = [];

        foreach ($this->data as $key => $value) {
            if (Str::startsWith($key, 'permissions_group_') && is_array($value)) {
                $permissions = array_merge($permissions, $value);
            }
        }

        logger("info", [$permissions]);
        $this->record->syncPermissions($permissions);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Hapus field virtual yang tidak perlu disimpan ke tabel
        return collect($data)
            ->reject(fn ($_, $key) => $key === 'permissions_state' || str($key)->startsWith('permissions_group_'))
            ->toArray();
    }
}
