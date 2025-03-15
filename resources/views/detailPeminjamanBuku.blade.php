<x-layout>
    <x-slot:titlePage>Perpustakaan - Peminjaman</x-slot>
    <div class="flex justify-center items-center min-h-screen my-4">
        <div class="w-96 mx-auto bg-gray-800 rounded-xl border">
            <div class="flex gap-2 items-center justify-center py-4 bg-blue-900 rounded-t-xl border-b">
                <img src="{{ $BASEURL }}/img/assets/library.png" alt="" class="w-8">
                <h1 class="text-white font-bold">Perpustakaan</h1>
            </div>
            <div class="grid grid-cols-[0.8fr,0.1fr,1fr] pl-10 my-4">
                <p class="block mb-2 text-sm font-medium text-white">Tanggal Peminjaman</p>
                <p class="block mb-2 text-sm font-medium text-white">:</p>
                <p class="block mb-2 text-sm font-medium text-white">{{ $peminjam->tanggal_pinjam }}</p>
                <p class="block mb-2 text-sm font-medium text-white">Tenggat</p>
                <p class="block mb-2 text-sm font-medium text-white">:</p>
                <p class="block mb-2 text-sm font-medium text-white">{{ $peminjam->tenggat_pengembalian }}</p>
            </div>
            <div class="grid grid-cols-[0.8fr,0.1fr,1fr] pl-10 my-6 mr-2">
                <p class="block mb-2 text-sm font-medium text-white">Peminjam</p>
                <p class="block mb-2 text-sm font-medium text-white">:</p>
                <p class="block mb-2 text-sm font-medium text-white">{{ $peminjam->user->name }}</p>
                <p class="block mb-2 text-sm font-medium text-white">Buku</p>
                <p class="block mb-2 text-sm font-medium text-white">:</p>
                <p class="block mb-2 text-sm font-medium text-white">{{ $book->title }}</p>
                <p class="block mb-2 text-sm font-medium text-white">Penulis</p>
                <p class="block mb-2 text-sm font-medium text-white">:</p>
                <p class="block mb-2 text-sm font-medium text-white">{{ $book->author }}</p>
                <p class="block mb-2 text-sm font-medium text-white">ISBN</p>
                <p class="block mb-2 text-sm font-medium text-white">:</p>
                <p class="block mb-2 text-sm font-medium text-white">{{ $book->isbn }}</p>
            </div>
            <figure class="mx-10 mb-6 space-y-1">
                <img src="{{ $BASEURL }}/img/books/{{ $book->foto }}" alt="buku" class="rounded-lg">
                <figcaption class="text-center text-gray-400 text-sm">{{ $book->title }}</figcaption>
            </figure>
            <div>
                <ul class="list-disc mx-14 mb-4">
                    <li class="text-sm text-gray-400">Jangan lupa kembalikan buku sebelum waktu tenggat, selamat membaca😊</li>
                </ul>
            </div>
        </div>
    </div>

    <x-status></x-status>

</x-layout>