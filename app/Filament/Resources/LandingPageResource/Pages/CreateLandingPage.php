<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use App\Filament\Resources\LandingPageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLandingPage extends CreateRecord
{
    protected static string $resource = LandingPageResource::class;

    public function getTitle(): string {
        return 'Ship Entry Report';
    }

    // public function getMaxContentWidth(): string {
    //     return 'full';
    // }

    protected function getCreateFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Submit'),
        ];
    }


}