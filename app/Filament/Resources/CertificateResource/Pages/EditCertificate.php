<?php

namespace App\Filament\Resources\CertificateResource\Pages;

use App\Filament\Resources\CertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCertificate extends EditRecord
{
    protected static string $resource = CertificateResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldLogo = $this->record->logo;

        // Jika logo berubah dan ada logo lama
        if (!empty($data['logo']) && $data['logo'] !== $oldLogo) {
            if (Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
        }

        return $data;
    }
}
