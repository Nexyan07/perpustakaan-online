<x-layout>
    <x-slot:titlePage>Perpustakaan - Denda</x-slot>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-96 mx-auto bg-gray-800 rounded-xl border">
            <h1 class="text-white text-center text-xl font-bold my-6">Denda</h1>
        <div class="">
            <h3 class="text-white mx-10 text-xl">Denda :</h3>
            <div class="my-3 space-y-1">
                @forelse ($fines as $fine)
                <div class="flex gap-2 relative hover:scale-[1.02] transition-all border mx-3 rounded-lg py-3">
                    <div class="flex items-center ml-10 w-[35%]">
                        <img src="{{ $BASEURL }}/img/books/{{ $fine->book->foto }}" alt="buku" class="h-16 w-24">
                    </div>
                    <div>
                        <p class="text-white text-sm mb-1">{{ $fine->book->title }}</p>
                        <p class="text-gray-300 text-xs">Denda saat ini : {{ $fine->jumlah }}</p>
                    </div>
                </div>
                @empty
                <div class="mx-3 h-full border rounded lg">
                    <h1 class="text-gray-300 text-center text-sm my-6">Tidak ada Denda</h1>
                </div>
                @endforelse
            </div>
            <p class="mx-10 text-xs my-2 text-gray-400">Bagi peminjam yang tidak membayar denda, tidak dapat melakukan peminjaman sebelum membayar dendanya</p>
            <div>
                <a href="/profile">
                    <button class="text-white bg-primary-700 hover:bg-primary-800 w-full rounded-b-xl py-2.5 mt-2">Kembali</button>
                </a>
            </div>
        </div>
    </div>
</div>
</x-layout>