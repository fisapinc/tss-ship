<?php
namespace App\Filament\Clusters\Configuration\Resources\VhfEntryResource\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use App\Filament\Clusters\Configuration\Resources\VhfEntryResource;

class ManageVhfEntry extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.empty';

    public function mount(): void
    {
        $this->form->fill(); 
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.pages.empty', [
            'form' => $this->form,
        ]);
    }

    public function getFormSchema(): array
    {
        return VhfEntryResource::getVhfEntriesFormSchema();
    }

    public \Filament\Forms\Form $form;

    public function submit(): void
    {
        $data = $this->form->getState();

        \App\Models\VhfEntry::create($data);

        $this->dispatch('notify', title: 'Saved successfully!');
        $this->form->fill();
    }

    protected function getFormModel(): string
    {
        return \App\Models\VhfEntry::class;
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }
}
