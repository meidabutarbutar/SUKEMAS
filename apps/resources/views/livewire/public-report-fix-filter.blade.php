<div class="mx-auto max-w-7xl grid grid-cols-6 gap-2 mt-8">
    <div class="col-span-1">
        <img class="" src="{{ $tenant->getQRCodeUrl() }}">
    </div>
    <div class="col-span-4">
        <h1 class="text-lg font-bold">{{ $tenant->name }} @isset($tenant->website)
                (<a href="{{ $tenant->website }}" class="hover:underline">Website</a>)
            @endisset
        </h1>
        <p class="text-md font-medium">{{ $tenant->address }}</p>
        <p class="text-md font-medium">{{ $tenant->district->name }}, {{ $tenant->regency->name }},
            {{ $tenant->province->name }} - {{ $tenant->postal_code }}</p>
    </div>
    <div class="col-span-1">
        <form wire:submit.prevent="submit">
            {{ $this->form }}
        </form>
    </div>
</div>
