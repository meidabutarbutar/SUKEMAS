<div class="mx-auto max-w-7xl grid grid-cols-4 gap-2">
    <div class="">
        <h1 class="text-xl font-bold">{{ $tenant->name }}</h1>
        <img class="" src="{{ $tenant->getQRCodeUrl() }}">
    </div>
    <div class="col-span-3">
        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-6">
                <div class="col-span-5">
                    {{ $this->form }}
                </div>
                <div class="flex items-center">
                    <button type="submit"
                        class="align-middle filament-button filament-button-size-md inline-flex items-center justify-center my-2 py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
