<x-layout>
    <x-slot:titlePage>Perpustakaan - Katalogs</x-slot>
    <x-navbar></x-navbar>
    
    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <h2 class="mt-3 text-h2-responsive font-semibold text-white sm:text-2xl">Katalog</h2>
                <div class="ml-auto sm-max:mr-auto sm-max:ml-0">
                    <div class="ml-auto sm:text-center">
                        <div class="items-center ml-auto max-w-screen-sm flex">
                            <div class="relative w-full">
                                <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cari Buku</label>
                                <div class="absolute flex items-center inset-y-0 pl-3">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                                </div>
                                <input id="search" name="keyword" class="block p-2 pl-9 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-lg focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari Artikel" type="text" id="keyword" autocomplete="off">
                            </div>
                            </div>
                    </div>
                </div>
          </div>
          <div id="book-container" class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($books as $book)
              @include('partials.book-card', ['book' => $book])
            @endforeach
          </div>
          <div class="flex justify-center">
            <button id="show-more-btn" class="border border-gray-700 px-5 py-2.5 rounded-lg text-gray-400 hover:bg-gray-700">Show More</button>
          </div>
        </div>
      </section>
    
    <x-footer></x-footer>

    @section('script')

    <script>
        let offset = 20; // Mulai dari 20 karena data awal sudah ada
        let limit = 20;
        let typingTimer;
        let doneTypingInterval = 300;
    
        function loadMoreBooks( reset = false ) {
            let keyword = $("#search").val();

            if (reset) {
                offset = 0;
                $("#book-container").html(""); // Kosongkan kontainer buku
                $("#show-more-btn").hide(); // Tampilkan tombol Show More jika ada data
            }

            $.ajax({
                url: "/load-more-books",
                type: "GET",
                data: { offset: offset, keyword: keyword },
                success: function(response) {
                    if (response.html.trim() !== "") {
                        $("#book-container").append(response.html); // Tambahkan data buku baru
                        offset += limit;

                        if(!response.hasMore) {
                            $("#show-more-btn").hide(); // Sembunyikan tombol Show More jika tidak ada lagi buku
                        } else {
                            $("#show-more-btn").show(); // Tampilkan tombol Show More jika ada data
                        }
                    } else {
                        $("#show-more-btn").hide(); // Sembunyikan tombol jika tidak ada lagi buku
                    }
                }
            });
        }
    
        $(document).ready(function() {
            $("#show-more-btn").click(function() {
                loadMoreBooks();
            });

            $('#search').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    loadMoreBooks(true);
                }, doneTypingInterval);
            });
          });
    </script>

    @endsection
    
</x-layout>