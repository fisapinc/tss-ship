<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use App\Models\VhfEntry;
use App\Filament\Resources\LandingPageResource;

class PublicVhfEntry extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Wizard::make([
                    \Filament\Forms\Components\Wizard\Step::make('Ship Details')
                        ->schema(LandingPageResource::getShipDetailsFormSchema()),

                    \Filament\Forms\Components\Wizard\Step::make('Route Information')
                        ->schema(LandingPageResource::getRouteInformationFormSchema()),

                    \Filament\Forms\Components\Wizard\Step::make('Cargo Information')
                        ->schema(LandingPageResource::getCargoInformationFormSchema()),

                    \Filament\Forms\Components\Wizard\Step::make('Confirmation & Submission')
                        ->schema(LandingPageResource::getConfirmationSubmissionFormSchema()),
                ])
                ->skippable()
                ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        VhfEntry::create($this->data);

        $this->reset('data');
        $this->dispatch('wizard::setStep', step: 1);
        $this->fillForm();

        session()->flash('message', 'Data submitted successfully!');
    }

    public function render()
    {
        return view('public-vhf-entry')
            ->layout('layouts.app'); 
    }

}
