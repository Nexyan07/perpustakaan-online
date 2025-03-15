<x-layout>
    <x-slot:titlePage>Perpustakaan - Katalog</x-slot>
    <section class="bg-gray-900 min-h-screen flex items-center">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl h-auto border rounded-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <a href="{{ $BASEURL; }}/img/books/{{ $book->foto }}">
                <img class="w-full block rounded-lg shadow-lg shadow-white" src="{{ $BASEURL; }}/img/books/{{ $book->foto }}" alt="book image">
            </a>
            <div class="mt-6 md:mt-2">
                <h2 class="text-h3-responsive tracking-tight font-extrabold text-white leading-[1]">{{ $book->title }}</h2>
                <h4 class="text-xl tracking-tight font-bold text-gray-400">By. {{ $book->author }}</h4>
                <h4 class="mb-1 text-xl tracking-tight font-bold text-gray-400">Publisher : {{ $book->publisher }}</h4>
                <p class="mb-1 font-light md:text-lg text-gray-400">Books available : {{ $book->copies_available }}</p>
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach ($genres as $genre)
                    <a href="/katalogs?genre={{ $genre->name }}" class="text-sm font-medium text-white bg-{{ $genre->color }}-500 px-2 py-1 rounded">{{ $genre->name }}</a>
                    @endforeach
                </div>
                <div class="mb-6 max-h-40 overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-gray-900">
                    <p class="font-light md:text-lg text-gray-400">{{ $book->description }}</p>
                </div>
                <a href="{{ url()->previous() }}" class="mr-4 inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-primary-900">Kembali</a>
                <button type="button" data-modal-target="peminjamanModal" data-modal-toggle="peminjamanModal" class="inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-primary-900">Ajukan Peminjaman</button>
            </div>
        </div>
        {{-- modal --}}
        <!-- Main modal -->
        <x-peminjaman>
            <x-slot:user>{{ $user->name }}</x-slot>
            <x-slot:book>{{ $book->title }}</x-slot>
            <x-slot:id>{{ $book->id }}</x-slot>
        </x-peminjaman>

        <x-status></x-status>
    </section>
</x-layout>