<x-app-layout>
    <x-slot:title>
        {{ $title ?? 'Survey' }}
    </x-slot>

    <div class="mx-auto w-8/12">
        <div class="px-6 py-48 flex items-center sm:px-6 sm:py-32 lg:px-8">
            <div class="bg-white mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Terima Kasih Telah Mengisi Survei</h2>
                <p class="mx-auto mt-6 max-w-xl text-lg font-semibold leading-8 text-gray-700">Salam hangat,<br>{{ $tenant->name }}</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('survey', ['tenant' => $tenant->token]) }}"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kembali ke halaman survei <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('survey', ['tenant' => $tenant->token]) }}";
        }, 10000);
    </script>
</x-app-layout>
