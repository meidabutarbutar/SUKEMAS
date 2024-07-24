<div class="mx-auto w-8/12 mt-12">
    <div class="flex items-center my-6">
        <div class="bg-white mx-auto max-w-3xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Masukkan Token Instansi</h2>
            <p class="mx-auto mt-2 w-full text-lg font-semibold leading-8 text-gray-700"></p>
        </div>
    </div>

    <div class="mx-auto w-64 mt-12">
        <form wire:submit.prevent="submit" class="space-y-8">
            {{ $this->form }}

            <x-filament::button wire:click="openReport" form="tenant-selection">
                Lihat Laporan
            </x-filament::button>
            <x-filament::button type="submit" form="tenant-selection" class="float-right">
                Isi Survei
            </x-filament::button>
        </form>

    </div>
</div>
