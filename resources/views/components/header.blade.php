<header class="bg-gray-900 shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center sm-max:flex-col sm-max:items-start gap-2">
      <h1 class="text-3xl font-bold tracking-tight text-white">Katalog</h1>
    
      <div class="ml-auto sm-max:mr-auto sm-max:ml-0">
        <div class="ml-auto sm:text-center">
          <form action="#">
            @if (request('category'))
              <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
              <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
              <div class="items-center ml-auto max-w-screen-sm flex">
                  <div class="relative w-full">
                      <label for="email" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cari Artikel</label>
                      <div class="absolute flex items-center inset-y-0 pl-3">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                      </div>
                      <input name="keyword" class="block p-2 pl-9 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari Artikel" type="text" id="keyword" autocomplete="off">
                    </div>
                    <div>
                      <button type="submit" class="py-2 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-gray-700 border-gray-600 sm:rounded-none sm:rounded-r-lg hover:bg-gray-800 focus:ring-4 focus:ring-gray-300">OK</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </header>