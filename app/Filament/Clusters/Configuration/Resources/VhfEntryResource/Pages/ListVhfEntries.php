<?php

namespace App\Filament\Clusters\Configuration\Resources\VhfEntryResource\Pages;

use App\Filament\Clusters\Configuration\Resources\VhfEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVhfEntries extends ListRecords
{
    protected static string $resource = VhfEntryResource::class;

    public function getTitle(): string
    {
        return 'VHF Form';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
