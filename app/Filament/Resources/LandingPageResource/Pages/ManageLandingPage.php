<?php
namespace App\Filament\Resources\LandingPageResource\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use App\Filament\Resources\LandingPageResource;
use Filament\Forms\Components\Wizard;

class ManageLandingPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = \App\Filament\Resources\LandingPageResource::class;

    protected static string $view = 'filament.pages.empty';

    //auto fill-form
    // public function mount(): void
    // {
    //     $this->form->fill(); 
    // }

    // public function render(): \Illuminate\Contracts\View\View
    // {
    //     return view('filament.pages.empty', [
    //         'form' => $this->form,
    //     ]);
    // }

    // public function getFormSchema(): array
    // {
    //     return [
    //         Wizard::make([
    //             Wizard\Step::make('Ship Details')
    //             ->schema(LandingPageResource::getShipDetailsFormSchema()),
    //             Wizard\step::make('Route Information')
    //             ->schema(LandingPageResource::getRouteInformationFormSchema()),
    //             Wizard\step::make('Cargo Information')
    //             ->schema(LandingPageResource::getCargoInformationFormSchema()),
    //             Wizard\Step::make('Confirmation & Submission')
    //                 ->schema([
    //                     \Filament\Forms\Components\Placeholder::make('confirmation')
    //                         ->content('You can submit your form now.')
    //                 ]),
    //         ])
    //         ->submitAction(new \Filament\Forms\Components\Actions\ButtonAction('submit')
    //             ->label('Submit')
    //             ->action('submit'))
    //     ];
    // }

    // public function submit(): void
    // {
    //     $data = $this->form->getState();

    //     \App\Models\VhfEntry::create($data);

    //     $this->dispatch('notify', title: 'Saved successfully!');
    //     $this->form->fill();
    // }

    // protected function getFormModel(): string
    // {
    //     return \App\Models\VhfEntry::class;
    // }

    // protected function getFormStatePath(): string
    // {
    //     return 'data';
    // }

    // public function getForm(): Form
    // {
    //     return $this->makeForm()
    //         ->model($this->getFormModel())
    //         ->schema($this->getFormSchema())
    //         ->statePath($this->getFormStatePath());
    // }
}
