<x-filament::page>
    <div x-data="{ tab: 'submission' }">
        <div class="flex space-x-2 mb-4">
            <button @click="tab = 'submission'" :class="{ 'bg-primary-600 text-white': tab === 'submission' }" class="px-4 py-2 border rounded">Submission List</button>
            <button @click="tab = 'create'" :class="{ 'bg-primary-600 text-white': tab === 'create' }" class="px-4 py-2 border rounded">Create VHF Entry</button>
        </div>

        <div x-show="tab === 'submission'" wire:ignore>
            @livewire(\App\Filament\Clusters\VhfManagement\Resources\EntryReportListResource\Pages\ManageEntryReportList::class)
        </div>

        <div x-show="tab === 'create'" wire:ignore>
            @livewire(\App\Filament\Clusters\VhfManagement\Resources\VhfEntriesResource\Pages\ManageVhfEntries::class)
        </div>
    </div>
</x-filament::page>