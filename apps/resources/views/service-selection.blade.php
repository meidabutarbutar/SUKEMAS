<x-app-layout>
    <x-slot:title>
        {{ $title ?? 'Pilih Layanan' }}
    </x-slot>

    <x-service-selection :tenant="$tenant"/>
</x-app-layout>
