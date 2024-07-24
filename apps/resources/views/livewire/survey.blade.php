<div class="mx-auto w-8/12 mt-12">
    <div class="flex items-center my-6">
        <div class="bg-white mx-auto max-w-3xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pengisian Survei</h2>
            <p class="mx-auto mt-2 w-full text-lg font-semibold leading-8 text-gray-700">Layanan: {{ $service->name }}<br>{{ $division->name }}<br>{{ $tenant->name }}</p>
        </div>
    </div>

    <form wire:submit.prevent="submit">
        {{ $this->form }}
    </form>
</div>
