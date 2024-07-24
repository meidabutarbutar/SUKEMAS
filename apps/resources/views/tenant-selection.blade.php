<x-app-layout>
    <x-slot:title>
        {{ $title ?? 'Instansi' }}
    </x-slot>

    <livewire:tenant-selection />
</x-app-layout>
