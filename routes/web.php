<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
//use App\Filament\Pages\PublicVhfEntryPage;
use App\Http\Livewire\PublicVhfEntry;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vhf-entry', PublicVhfEntry::class);
