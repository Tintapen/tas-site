<?php

namespace App\Filament\Resources\SocialmediaResource\Pages;

use App\Filament\Resources\SocialmediaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialmedia extends EditRecord
{
    protected static string $resource = SocialmediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
