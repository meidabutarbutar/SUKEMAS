<x-app-layout>
    <x-slot:title>
        {{ $title ?? 'Home' }}
        </x-slot>

        <!-- Hero section -->
        <div class="relative isolate overflow-hidden">
            <div class="mx-auto max-w-7xl px-4 sm:py-0 lg:flex">
                <div class="mx-auto max-w-3xl flex-shrink-0 lg:mx-0 lg:max-w-xl lg:pt-24">
                    <h1 class="mt-4 text-6xl font-bold tracking-tight text-grey-200 sm:text-5xl">Survei Kepuasan
                        Masyarakat</h1>
                    <p class="mt-6 text-3xl leading-loose text-gray-700">Mengukur <span class="font-semibold underline">mutu pelayanan publik</span> untuk perbaikan
                        tata kelola yang <span class="font-bold" x-data="{ texts: ['transparan.', 'tepat sasaran.', 'berkelanjutan.'] }" x-typewriter.2000ms="texts"></span></p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ route('survey') }}"
                            class="rounded-md bg-green-700 px-4 py-3 text-lg font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-400">Isi
                            Survei ></a>
                        <a href="{{ route('register') }}"
                            class="rounded-md bg-indigo-700 px-4 py-3 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">Daftarkan Instansi Anda, Gratis!</a>
                    </div>
                    <h2
                        class="mt-12 border-l-4 pl-2 border-indigo-600 text-2xl font-bold tracking-tight text-grey-200 sm:text-3xl">
                        Berbagai Fitur Unggulan:
                    </h2>
                    <div class="ml-4 grid grid-cols-2 gap-x-8 font-medium">
                        <div>
                            <ul class="mt-4 list-disc text-lg leading-loose text-gray-600">
                                <li>Survei kepuasan layanan.</li>
                                <li>Menejemen operator.</li>
                                <li>Manajemen sub-unit dan layanan.</li>
                                <li>Manajemen pertanyaan survei.</li>
                                <li>Profil instansi.</li>
                            </ul>
                        </div>
                        <div>
                            <ul class="mt-4 list-disc text-lg leading-loose text-gray-600">
                                <li>Kemanan data.</li>
                                <li><span class="italic">Realtime report</span>.</li>
                                <li>Akses laporan dengan QRCode.</li>
                                <li>Ekspor data (pdf, xlsx).</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mx-auto flex max-w-2xl lg:ml-2 lg:mr-0 lg:max-w-none lg:flex-none xl:ml-4">
                    <div class="max-w-lg flex-none sm:max-w-5xl lg:max-w-none">
                        <lottie-player autoplay loop mode="normal" src="/lottie/customer-rating.json"></lottie-player>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
