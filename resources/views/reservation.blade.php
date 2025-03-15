<x-layout>
    <x-slot:titlePage>Perpustakaan - Reservation</x-slot>
    <div class="flex justify-center items-center min-h-screen my-4">
        <div class="w-96 mx-auto bg-gray-800 rounded-xl border">
            <div class="flex gap-2 items-center justify-center py-4 bg-blue-900 rounded-t-xl border-b">
            <img src="{{ $BASEURL }}/img/assets/library.png" alt="" class="w-8">
            <h1 class="text-white font-bold">Perpustakaan</h1>
        </div>
        <div class="grid grid-cols-[0.8fr,0.1fr,1fr] pl-10 my-4">
            <p class="block mb-2 text-sm font-medium text-white">Tanggal Reservasi</p>
            <p class="block mb-2 text-sm font-medium text-white">:</p>
            <p class="block mb-2 text-sm font-medium text-white">{{ $reservation->reserved_at }}</p>
            <p class="block mb-2 text-sm font-medium text-white">Tenggat Reservasi</p>
            <p class="block mb-2 text-sm font-medium text-white">:</p>
            <p class="block mb-2 text-sm font-medium text-white">{{ $reservation->expiration_date }}</p>
        </div>
        <div class="grid grid-cols-[0.8fr,0.1fr,1fr] pl-10 my-6 mr-2">
            <p class="block mb-2 text-sm font-medium text-white">Calon Peminjam</p>
            <p class="block mb-2 text-sm font-medium text-white">:</p>
            <p class="block mb-2 text-sm font-medium text-white">{{ $reservation->user->name }}</p>
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
            <ul class="list-disc mx-10 text-center mb-4">
                <li class="text-sm text-gray-400">Tunjukan ini pada petugas perpustakaan saat ingin mengambil buku yang telah direservasi</li>
            </ul>
        </div>
        <div class="flex justify-center items-center gap-4 mb-4 mx-10">
            <a href="/reservations" class="flex-1 justify-center inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900">Daftar Reservasi</a>
            <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="justify-center inline-flex items-center text-white text-sm bg-red-600 hover:bg-red-700 rounded-xl flex-1 py-2.5 px-5">Batalkan Reservasi</button>
        </div>
    </div>
</div>

    {{-- modal --}}
    <x-delete-modal>
        <x-slot:message>Yakin ingin membatalkan reservasi?</x-slot>
        <form action="{{ route('userReservation.destroy', $reservation->id) }}" method="POST">
    </x-delete-modal>

    <x-status></x-status>

</x-layout>