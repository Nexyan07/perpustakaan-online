<div id="peminjamanModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl">
                <div class="relative p-4 w-full max-w-2xl bg-gray-800 rounded-lg shadow-lg max-h-[calc(100%-2rem)]">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Pengajuan Peminjaman
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="peminjamanModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="grid grid-cols-[2fr,0.3fr,7fr] md:grid-cols-[1.7fr,0.1fr,4fr] gap-y-2">
                        <p class="font-light text-white leading-[1.25]">User</p>
                        <p class="font-light text-white leading-[1.25]">:</p>
                        <p class="font-light text-white leading-[1.25]">{{ $user }}</p>
                        <p class="font-light text-white leading-[1.25]">Buku</p>
                        <p class="font-light text-white leading-[1.25]">:</p>
                        <p class="font-light text-white leading-[1.25]">{{ $book }}</p>
                        <p class="font-light text-white leading-[1.25]">Tenggat Pengambilan</p>
                        <p class="font-light text-white leading-[1.25]">:</p>
                        <p class="font-light text-white leading-[1.25]">{{ now()->addDays(2)->format('d-m-Y') }}</p>
                    </div>
                    <ul class="list-disc ml-4 mt-4">
                        <li class="text-sm text-gray-400">Buku yang tidak diambil selama 2 hari akan dibatalkan dari pengajuan peminjaman dan akan dikenakan sanksi sebesar Rp10.000</li>
                        <li class="text-sm text-gray-400">Peminjam yang tidak mengembalikan buku sesuai batas waktu pengembalian akan dikenakan sanksi sebesar Rp5.000</li>
                        <li class="text-sm text-gray-400">Buku yang dikembalikan dalam keadaan rusak/hilang akan dikenakan sanksi</li>
                        <li class="text-sm text-gray-400">Pembatalan ajuan peminjaman buku dapat dilakukan di halaman profil</li>
                    </ul>
                        <form action="{{ route('reservation', ['id' => $id]) }}" method="POST" class="flex justify-end border-t border-gray-600 mt-4 sm:mt-5">
                            @csrf
                            <button type="submit" class="mt-2 inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-primary-900">Ajukan Peminjaman</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>