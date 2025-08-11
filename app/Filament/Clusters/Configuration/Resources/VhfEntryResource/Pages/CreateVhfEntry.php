<?php

namespace App\Filament\Clusters\Configuration\Resources\VhfEntryResource\Pages;

use App\Filament\Clusters\Configuration\Resources\VhfEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVhfEntry extends CreateRecord
{
    protected static string $resource = VhfEntryResource::class;

     public function getTitle(): string
    {
        return 'VHF Form';
    }
}
