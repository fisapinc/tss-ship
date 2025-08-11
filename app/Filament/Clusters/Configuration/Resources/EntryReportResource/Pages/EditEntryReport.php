<?php

namespace App\Filament\Clusters\Configuration\Resources\EntryReportResource\Pages;

use App\Filament\Clusters\Configuration\Resources\EntryReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntryReport extends EditRecord
{
    protected static string $resource = EntryReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
