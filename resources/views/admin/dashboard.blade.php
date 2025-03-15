<x-layout>
    <x-slot:titlePage>Perpustakaan - Dashboard</x-slot>
    <x-sidebar></x-sidebar>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Dashboard</h2>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <a href="/table-users">
                            <img src="{{ $BASEURL }}/img/assets/user.png" class="w-6">
                        </a>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-white">Pengguna</h3>
                    <p class="text-gray-400">Total pengguna yang telah terdaftar saat ini adalah {{ $users }}</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <a href="/table-books">
                            <img src="{{ $BASEURL }}/img/assets/open-book.png" class="w-6">
                        </a>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Buku</h3>
                    <p class="text-gray-500 dark:text-gray-400">Total buku yang telah terdaftar saat ini adalah {{ $books }}</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <a href="/table-peminjam">
                            <img src="{{ $BASEURL }}/img/assets/peminjam.png" class="w-7">
                        </a>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Peminjaman</h3>
                    <p class="text-gray-500 dark:text-gray-400">Buku yang sedang dalam peminjaman saat ini sebanyak {{ $peminjam }}</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <a href="/table-reservation">
                            <img src="{{ $BASEURL }}/img/assets/reserved.png" class="w-7">
                        </a>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Reservation</h3>
                    <p class="text-gray-500 dark:text-gray-400">Buku yang sedang dalam tahap reservasi saat ini sebanyak {{ $reservations }}</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <a href="/table-fines">
                            <img src="{{ $BASEURL }}/img/assets/penalty.png" class="w-8">
                        </a>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Denda</h3>
                    <p class="text-gray-500 dark:text-gray-400">Peminjam yang belum membayar denda saat ini sebanyak {{ $fines }}</p>
                </div>
            </div>
        </div>
      </section>
</x-layout>