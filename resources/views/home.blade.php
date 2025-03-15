<x-layout>
    <x-slot:titlePage>Perpustakaan - Home</x-slot>
    <x-navbar></x-navbar>

    {{-- header start --}}
    <div class="w-full relative bg-[url('http://perpuss.test/img/assets/perpus.jpg')] h-[calc(100vh-4rem)] bg-cover flex justify-center items-center">
        <div class="bg-[rgba(0,0,0,0.5)] w-4/5 rounded-xl px-8 py-5 border-2 border-white grid gap-5">
            <h1 class="text-h1-responsive font-extrabold text-white text-center">Welcome</h1>
            <h3 class="text-h5-responsive font-bold text-white text-center">Temukan, baca, dan pelajari koleksi buku terbaik kami</h3>
            <div class="flex flex-wrap justify-center items-center gap-4">
                @if (!Auth::check())
                <a href="/login">
                    <button class="sm:text-sm lg:text-lg min-w-32 w-44 text-white border border-white rounded-lg shadow-sm shadow-white sm:px-2 lg:px-4 py-2 hover:scale-105 transition">Login</button>
                </a>
                @endif
                <a href="/katalogs">
                    <button class="sm:text-sm lg:text-lg min-w-32 w-44 text-white border border-white rounded-lg shadow-sm shadow-white sm:px-2 lg:px-4 py-2 hover:scale-105">Jelajahi Katalog</button>
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>
    </div>
    {{-- header end --}}

    {{-- content start --}}
    <section class="bg-gray-900">
        <h1 class="text-h2-responsive font-extrabold text-white text-center mt-8">Populer Book</h1>
        @foreach ($books as $book)
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:flex sm:py-16 lg:px-6
        {{ $loop->iteration % 2 == 0 ? 'md:flex-row-reverse' : '' }}">
            <img class="w-full md:w-1/2 block rounded" src="{{ $BASEURL }}/img/books/{{ $book->foto }}" alt="{{ $book->title }}">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-h4-responsive tracking-tight font-bold text-white">{{ $book->title }}</h2>
                <h4 class="mb-4 text-xl tracking-tight font-bold text-white">By {{ $book->author }}</h4>
                <div class="max-h-40 overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-gray-900">
                    <p class="mb-3 font-light text-gray-500 md:text-lg dark:text-gray-400">{{ $book->description }}</p>
                </div>
                {{-- rating --}}
                <div class="flex gap-2">
                    <div class="flex mb-3">
                        @for ($i = 0; $i < floor($book->ratings_avg_rating); $i++)
                        <svg class="h-7 w-7 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>
                        @endfor
                        @if ($book->ratings_avg_rating - floor($book->ratings_avg_rating) > 0)
                        <svg class="h-7 w-7 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <defs>
                            <clipPath id="half-star-{{ $book->id }}">
                                <rect x="0" y="0" width="12" height="24" />
                            </clipPath>
                            </defs>
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" fill="#d1d5db" />
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" fill="#facc15" clip-path="url(#half-star-{{ $book->id }})" />
                        </svg>
                        @endif
                        @for ($i = ceil($book->ratings_avg_rating); $i < 5; $i++)
                        <svg class="h-7 w-7 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>
                        @endfor
                    </div>
                    <div class="flex mt-[2px] gap-1">
                        <p class="text-lg font-medium text-white">{{ number_format($book->ratings_avg_rating, 2) }}</p>
                        <p class="text-lg font-medium text-gray-400">({{ $book->ratings_count }})</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <a href="/katalogs/{{ $book->slug }}" class="w-32 justify-center inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900">
                        Lihat
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    {{-- content end --}}

    <x-footer></x-footer>

    <x-status></x-status>
</x-layout>