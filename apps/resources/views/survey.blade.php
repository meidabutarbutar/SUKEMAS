<x-app-layout>
    <x-slot:title>
        {{ $title ?? 'Survey' }}
    </x-slot>

    <livewire:survey :tenant="$tenant" :division="$division" :service="$service" />
</x-app-layout>
