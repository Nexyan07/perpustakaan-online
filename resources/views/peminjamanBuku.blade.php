<x-layout>
    <x-slot:titlePage>Perpustakaan - Peminjaman</x-slot>
    <div x-data="{user_id: '', book_id: ''}" class="flex justify-center items-center min-h-screen">
        <div class="w-96 mx-auto bg-gray-800 rounded-xl border">
            <h1 class="text-white text-center text-xl font-bold my-6">Peminjaman</h1>
            <div class="">
                <h3 class="text-white mx-10 text-xl">Dipinjam :</h3>
                <div class="my-3 space-y-1">
                    @forelse ($peminjam as $p)
                        <div class="flex gap-2 relative hover:scale-[1.02] transition-all border mx-3 rounded-lg">
                            <p class="text-white text-xs mx-5 absolute left-0 mt-1 ">{{ $p->created_at->diffForHumans() }}</p>
                            <div class="flex items-center ml-10 mt-6 mb-3 w-[35%]">
                                <img src="{{ $BASEURL }}/img/books/{{ $p->book->foto }}" alt="buku" class="h-16 w-24">
                            </div>
                            <div class="mt-5 mb-3 mr-5 w-[65%]">
                                <p class="text-white text-sm mb-1 ">{{ $p->book->title }}</p>
                                <p class="text-gray-300 text-xs ">By. {{ $p->book->author }}</p>
                                <a href="/peminjaman/{{ $p->book->slug }}" class="">
                                    <button class="w-12 justify-center inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-xs px-5 text-center focus:ring-primary-900">Lihat</button>
                                </a>
                            </div>
                        </div>
                    @empty
                    <div class="mx-3 h-full border rounded lg">
                        <h1 class="text-gray-300 text-center text-sm my-6">Tidak ada buku yang sedang dipinjam</h1>
                    </div>
                    @endforelse
                </div>
                @if ($peminjamBelumRating->count() > 0)
                <h3 class="text-white mx-10 mt-4 mb-1 text-xl">Rating :</h3>
                <div class="mb-3 space-y-1">
                    @foreach ($peminjamBelumRating as $p)
                        <div class="flex gap-2 relative hover:scale-[1.02] transition-all border mx-3 rounded-lg">
                            <p class="text-white text-xs mx-5 absolute left-0 mt-1">{{ $p->created_at->diffForHumans() }}</p>
                            <div class="flex items-center ml-10 mt-6 mb-3 w-[35%]">
                                <img src="{{ $BASEURL }}/img/books/{{ $p->book->foto }}" alt="buku" class="h-16 w-24">
                            </div>
                            <div class="mt-5 mb-3 mr-5 w-[65%]">
                                <p class="text-white text-sm mb-1">{{ $p->book->title }}</p>
                                <p class="text-gray-300 text-xs">By. {{ $p->book->author }}</p>
                                <button @click="user_id='{{ $p->user_id }}'; book_id='{{ $p->book_id }}'" data-modal-target="ratingModal" data-modal-toggle="ratingModal" type="button" class="w-14 justify-center inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-xs px-5 text-center focus:ring-primary-900">Rating</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                <p class="mx-10 text-xs my-2 text-gray-400">Buku yang tidak dikembalikan sebelum waktu tenggat pengembalian akan dikenakan sanksi sesuai ketentuan yang berlaku.</p>
                <div>
                    <a href="/profile">
                        <button class="text-white bg-primary-700 hover:bg-primary-800 w-full rounded-b-xl py-2.5 mt-2">Kembali</button>
                    </a>
                </div>
            </div>
        </div>
        <x-rating-modal></x-rating-modal>
    </div>
    <x-status></x-status>
</x-layout>