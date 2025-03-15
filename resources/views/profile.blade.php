<x-layout>
    <x-slot:titlePage>Perpustakaan - Profile</x-slot>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-96 mx-auto bg-gray-800 rounded-xl border">
            <a href="/" class="absolute inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 rounded-tl-xl text-sm px-5 py-4 text-center focus:ring-gray-900">
                <img src="{{ $BASEURL }}/img/assets/back.png" class="w-4" alt="">
              </a>
            <div class="flex justify-center items-center my-8">
                <a href="{{ $BASEURL }}/img/users/{{ Auth::user()->foto }}">
                    <img src="{{ $BASEURL }}/img/users/{{ Auth::user()->foto }}" alt="profile" class="rounded-full w-32 shrink-0">
                </a>
            </div>
            <div class="flex flex-col justify-center">
                <div class="grid grid-cols-[0.75fr,0.1fr,1fr] pl-14">
                    <p class="block mb-2 text-sm font-medium text-white">Name</p>
                    <p class="block mb-2 text-sm font-medium text-white">:</p>
                    <p class="block mb-2 text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="block mb-2 text-sm font-medium text-white">Email</p>
                    <p class="block mb-2 text-sm font-medium text-white">:</p>
                    <p class="block mb-2 text-sm font-medium text-white">{{ Auth::user()->email }}</p>
                    <p class="block mb-2 text-sm font-medium text-white">Telepon</p>
                    <p class="block mb-2 text-sm font-medium text-white">:</p>
                    <p class="block mb-2 text-sm font-medium text-white">{{ Auth::user()->telepon }}</p>
                </div>
                <div class="flex my-4 justify-evenly">
                    <a href="/peminjaman">
                        <div class="flex flex-col items-center">
                            <div class="bg-white rounded-full p-2 relative">
                                <img src="{{ $BASEURL }}/img/assets/book-icon.png" alt="icon" class="w-10">
                                @if ($peminjam->count() > 0)
                                <div class="absolute right-0 top-0 rounded-full bg-red-600 text-white w-4 h-4">
                                    <p class="text-center text-xs">{{ $peminjam->count() }}</p>
                                </div>
                                @endif
                            </div>
                            <p class="block mb-2 text-sm font-medium text-white">Buku</p>
                        </div>
                    </a>
                    <a href="/reservations">
                        <div class="flex flex-col items-center">
                            <div class="bg-white rounded-full p-2 relative">
                                <img src="{{ $BASEURL }}/img/assets/reservation.png" alt="icon" class="w-10">
                                @if ($reservation->count() > 0)
                                <div class="absolute right-0 top-0 rounded-full bg-red-600 text-white w-4 h-4">
                                    <p class="text-center text-xs">{{ $reservation->count() }}</p>
                                </div>
                                @endif
                            </div>
                            <p class="block mb-2 text-sm font-medium text-white">Reservasi</p>
                        </div>
                    </a>
                    <a href="/denda">
                        <div class="flex flex-col items-center">
                            <div class="bg-white rounded-full p-2 relative">
                                <img src="{{ $BASEURL }}/img/assets/fine.png" alt="icon" class="w-10">
                                @if ($denda->count() > 0)
                                <div class="absolute right-0 top-0 rounded-full bg-red-600 text-white w-4 h-4">
                                    <p class="text-center text-xs">{{ $denda->count() }}</p>
                                </div>
                                @endif
                            </div>
                            <p class="block mb-2 text-sm font-medium text-white">Denda</p>
                        </div>
                    </a>
                </div>
                <div class="flex gap-4 px-10">
                    <a href="/edit-profile" class="flex-1">
                        <button class="w-full justify-center mb-4 inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-sm py-2.5 text-center focus:ring-primary-900">Edit Profile</button>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full justify-center mb-4 inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-sm py-2.5 text-center focus:ring-primary-900">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-status></x-status>
     
</x-layout>