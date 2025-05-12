<?php

namespace App\Filament\Resources\SysconfigResource\Pages;

use App\Filament\Resources\SysconfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSysconfigs extends ListRecords
{
    protected static string $resource = SysconfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
