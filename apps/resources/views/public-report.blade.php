<x-app-layout>
    <x-slot:title>
        {{ $title ?? 'Statistik' }}
    </x-slot>

    <div class="relative isolate overflow-hidden">
        <div class="mx-auto max-w-7xl p-4 sm:py-0 lg:flex">
            <livewire:public-report :tenant="$tenant" :startPeriod="$startPeriod" :endPeriod="$endPeriod" />
        </div>
    </div>
</x-app-layout>
