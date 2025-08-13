@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen">
    {{-- Header --}}
    <header class="bg-white border-b shadow-sm">
        <div class="max-w-6xl mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-lg font-bold">Public VHF Entry</h1>
            <a href="{{ filament()->getLoginUrl() }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Sign In
            </a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">
            <form wire:submit.prevent="submit">
                {{ $this->form }}

                <x-filament::button type="submit" class="mt-4">
                    Submit
                </x-filament::button>
            </form>

            @if (session()->has('message'))
                <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
