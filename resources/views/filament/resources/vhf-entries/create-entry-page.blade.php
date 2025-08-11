<x-filament::page>
    <form wire:submit.prevent="create">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4">Submit Entry</x-filament::button>
        <x-filament::button type="submit" class="mt-4">cancel</x-filament::button>
    </form>
</x-filament::page>
