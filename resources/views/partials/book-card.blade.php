<div class="rounded-lg border p-6 shadow-sm border-gray-700 bg-gray-800 flex flex-col h-full">
    <div class="h-40">
      <a href="img/books/{{ $book->foto }}">
        <img class="mx-auto h-full block rounded shadow shadow-white" src="{{ $BASEURL }}/img/books/{{ $book->foto }}" alt="{{ $book->foto }}" />
      </a>
    </div>
    <div class="pt-6 flex-grow">
      <div class="flex flex-col gap-1">
        <h4 class="text-lg font-semibold leading-tight text-white">{{ Str::limit($book->title, 45) }}</h4>
        <h6 class="text-md leading-tight text-white">By. {{ $book->author }}</h6>
      </div>
      <div class="mt-2 flex items-center gap-2">
        <div class="flex items-center">
          @for ($i = 0; $i < floor($book->ratings_avg_rating); $i++)
            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>
          @endfor
          @if ($book->ratings_avg_rating - floor($book->ratings_avg_rating) > 0)
            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
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
            <svg class="h-4 w-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>
          @endfor
        </div>
        <p class="text-sm font-medium text-white">{{ number_format($book->ratings_avg_rating, 2) }}</p>
        <p class="text-sm font-medium text-gray-400">({{ $book->ratings_count }})</p>
      </div>
    </div>
    <ul class="mt-2 flex flex-wrap items-center gap-2">
        @foreach ($book->genres as $genre)
        <li class="text-sm font-medium text-white bg-{{ $genre->color }}-500 px-2 py-1 rounded">{{ $genre->name }}</li>
        @endforeach
    </ul>
    <div class="w-full mt-4 flex items-center justify-center">
      <a href="/katalogs/{{ $book->slug }}" class="w-full">
        <button type="button" class="inline-flex items-center rounded-lg justify-center bg-primary-700 w-full py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          Lihat
        </button>
      </a>
    </div>
  </div>