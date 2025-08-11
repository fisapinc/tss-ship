<?php

namespace App\Filament\Clusters\Configuration\Resources\VhfEntryResource\Pages;

use App\Filament\Clusters\Configuration\Resources\VhfEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVhfEntry extends EditRecord
{
    protected static string $resource = VhfEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
