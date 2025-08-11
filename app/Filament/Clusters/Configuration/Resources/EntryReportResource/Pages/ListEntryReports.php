<?php

namespace App\Filament\Clusters\Configuration\Resources\EntryReportResource\Pages;

use App\Filament\Clusters\Configuration\Resources\EntryReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntryReports extends ListRecords
{
    protected static string $resource = EntryReportResource::class;

      public function getTitle(): string
    {
        return 'Submitted Entry Report List';
    }

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
