<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function afterSave(): void
    {
        $roleId = $this->form->getState()['role'] ?? null;

        if ($roleId) {
            $role = Role::findById($roleId); // Lebih aman karena otomatis pakai guard
            $this->record->syncRoles([$role]);
        } else {
            $this->record->syncRoles([]); // Jika tidak ada role, hapus semua
        }
    }
}
