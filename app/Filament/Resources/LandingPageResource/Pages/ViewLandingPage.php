<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use App\Filament\Resources\LandingPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;

class ViewLandingPage extends ViewRecord
{
    protected static string $resource = LandingPageResource::class;

    // public static function infolist(Infolist $infolist): Infolist {

    //     return $infolist
    //     ->schema([
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //         TextEntry::make('vessel_name'),
    //     ]);
    // }
}
