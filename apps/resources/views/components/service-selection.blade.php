<div class="mx-auto w-8/12 mt-12">
    <div class="flex items-center my-6">
        <div class="bg-white mx-auto max-w-3xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pilih Layanan</h2>
            <p class="mx-auto mt-2 w-full text-lg font-semibold leading-8 text-gray-700">{{ $tenant->name }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-md bg-white shadow">
        <div class="flex w-full flex-col">
            <div class="grid grid-cols-3 gap-2 items-center">
                @foreach ($services as $service)
                    <a href="{{ route('survey', ['tenant' => $tenant, 'service' => $service->id]) }}">
                        <div
                            class="pointer-events-auto flex w-full max-w-md rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-20 hover:bg-green-300">
                            <div class="w-0 flex-1 p-4">
                                <div class="flex items-start">
                                    <div class="ml-3 w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $service->name }}</p>
                                        <p class="mt-1 text-sm text-gray-500">{{ $service->division->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex border-l border-gray-200">
                                <div class="flex-shrink-0 p-4">
                                    <x-heroicon-o-arrow-circle-right class="w-6 h-6 text-gray-500" />
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
