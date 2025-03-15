<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>
 
<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full" aria-label="Sidenav">
    <div class="overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-gray-900 py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex gap-4 items-center border-b border-gray-700 pb-5 mb-5">
            <img src="{{ $BASEURL }}/img/users/{{ Auth::user()->foto }}" alt="" class="w-16 rounded-full">
            <div>
                <div class="text-base/5 font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <ul class="space-y-2">
           <li>
               <a href="/admin" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                   <span class="ml-3">Dashboard</span>
               </a>
           </li>
           <li>
               <button type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                   <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                   <span class="flex-1 ml-3 text-left whitespace-nowrap">Table</span>
                   <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
               </button>
               <ul id="dropdown-pages" class="hidden ml-4 py-2 space-y-2">
                   <li class="relative hover:bg-gray-700 rounded-lg transition duration-75">
                        <a href="/table-books">
                            <img src="{{ $BASEURL }}/img/assets/open-book.png" class="absolute top-1/2 -translate-y-1/2 left-3 w-5">
                            <div class="flex items-center p-2 pl-11 w-full text-base font-normal group text-white">Buku</div>
                        </a>
                    </li>
                   <li class="relative hover:bg-gray-700 rounded-lg transition duration-75">
                        <a href="/table-users">
                            <img src="{{ $BASEURL }}/img/assets/user.png" class=" absolute top-1/2 -translate-y-1/2 left-3 w-5">
                            <div class="flex items-center p-2 pl-11 w-full text-base font-normal group text-white">User</div>
                        </a>
                    </li>
                    <li class="relative hover:bg-gray-700 rounded-lg transition duration-75">
                        <a href="/table-peminjam">
                            <img src="{{ $BASEURL }}/img/assets/peminjam.png" class=" absolute top-1/2 -translate-y-1/2 left-3 w-5">
                            <div class="flex items-center p-2 pl-11 w-full text-base font-normal group text-white">Peminjaman</div>
                        </a>
                    </li>
                    <li class="relative hover:bg-gray-700 rounded-lg transition duration-75">
                        <a href="/table-reservations">
                            <img src="{{ $BASEURL }}/img/assets/reserved.png" class=" absolute top-1/2 -translate-y-1/2 left-3 w-5">
                            <div class="flex items-center p-2 pl-11 w-full text-base font-normal group text-white">Reservasi</div>
                        </a>
                    </li>
                    <li class="relative hover:bg-gray-700 rounded-lg transition duration-75">
                        <a href="/table-fines">
                            <img src="{{ $BASEURL }}/img/assets/penalty.png" class=" absolute top-1/2 -translate-y-1/2 left-3 w-5">
                            <div class="flex items-center p-2 pl-11 w-full text-base font-normal group text-white">Denda</div>
                        </a>
                    </li>
                    <li class="relative hover:bg-gray-700 rounded-lg transition duration-75">
                        <a href="/table-genres">
                            <img src="{{ $BASEURL }}/img/assets/genre.png" class=" absolute top-1/2 -translate-y-1/2 left-3 w-5">
                            <div class="flex items-center p-2 pl-11 w-full text-base font-normal group text-white">Genre</div>
                        </a>
                    </li>
                    <li class="relative hover:bg-gray-700 rounded-lg transition duration-75">
                        <a href="/table-ratings">
                            <img src="{{ $BASEURL }}/img/assets/rating.png" class=" absolute top-1/2 -translate-y-1/2 left-3 w-5">
                            <div class="flex items-center p-2 pl-11 w-full text-base font-normal group text-white">Rating</div>
                        </a>
                    </li>
               </ul>
       <ul class="pt-5 mt-5 space-y-2 border-t border-gray-700">
           <li>
               <a href="/katalogs" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                   <span class="ml-3">Perpustakaan</span>
               </a>
           </li>
           <li>
            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="flex items-center w-full p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <span class="ml-3">Logout</span>
                </button>
            </form>
           </li>
       </ul>
   </div>
 </aside>