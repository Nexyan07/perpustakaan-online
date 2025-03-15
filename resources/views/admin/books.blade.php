<x-table>
    <x-slot:section>
        <section x-data="{judulModal: '', id: '', title:'', author:'', publisher:'', year:'', rating:'', isbn:'', cTotal:'', cAvailable:'', foto:'', description: '', genres: ''}" class="bg-gray-900 p-3 sm:p-5 antialiased">
        
    </x-slot>
    <x-slot:title>Books</x-slot>
    <x-slot:dataCount>{{ $books->count() }}</x-slot>
    <x-slot:form>
        <form action="{{ route('book.index') }}" method="GET" class="flex items-center">
    </x-slot>
    <x-slot:buttonTambah>
        <button @click="judulModal = 'tambah'; id=''; title=''; author=''; publisher=''; year=''; rating=''; isbn=''; cTotal=''; cAvailable=''; foto=''; description= ''; genres= ''" type="button" id="defaultModalButton" data-modal-target="formModal" data-modal-toggle="formModal" class="flex items-center justify-center text-white focus:ring-4 font-medium rounded-lg text-sm px-4 py-2 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
    </x-slot>
    <x-slot:pagination>{{ $books->links() }}</x-slot>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">No</th>
                    <th scope="col" class="p-4">Foto</th>
                    <th scope="col" class="p-4">Title</th>
                    <th scope="col" class="p-4">Author</th>
                    <th scope="col" class="p-4">Publisher</th>
                    <th scope="col" class="p-4">Year</th>
                    <th scope="col" class="p-4">ISBN</th>
                    <th scope="col" class="p-4">Copies Total</th>
                    <th scope="col" class="p-4">Copies Available</th>
                    <th scope="col" class="p-4">Description</th>
                    <th scope="col" class="p-4">Genres</th>
                    <th scope="col" class="p-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                    <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center">
                            <a href="{{ $BASEURL }}/img/books/{{ $book->foto }}">
                                <img src="{{ $BASEURL }}/img/books/{{ $book->foto }}" alt="" class="h-8 w-auto">
                            </a>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->title }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->author }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->publisher }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->year }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->isbn }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->copies_total }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->copies_available }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ Str::limit($book->description, 10) }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ implode(', ', $book->genres->pluck('name')->toArray()) }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div  class="flex items-center space-x-4">
                            <button  @click="judulModal = 'edit'; id='{{ $book->id }}'; title='{{ $book->title }}'; author='{{ $book->author }}'; publisher='{{ $book->publisher }}'; year='{{ $book->year }}'; isbn='{{ $book->isbn }}'; cTotal='{{ $book->copies_total }}'; cAvailable='{{ $book->copies_available }}'; foto='{{ $book->foto }}'; description='{{ $book->description }}'; genres={{ json_encode($book->genres->pluck('name')->toArray()) }}" type="button" data-modal-target="formModal" data-modal-toggle="formModal" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                                Edit
                            </button>
                            <button @click="id = {{ $book->id }}" type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty 
                <tr>
                    <td height="80px" colspan="11"><h1 class="text-4xl text-center">Tidak ada Data</h1></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    <x-slot:modal>
        <x-modal>
            <form :action="(judulModal === 'edit' && id) ? '{{ route('book.update', '') }}/' + id : '{{ route('book.store') }}'" method="post" enctype="multipart/form-data">
                @csrf
                <template x-if="judulModal == 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-white">Judul</label>
                        <input :value="title" type="text" name="title" id="title" class=" border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Judul buku" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="author" class="block mb-2 text-sm font-medium  text-white">Author</label>
                        <input :value="author" type="text" name="author" id="author" class=" border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Author" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="publisher" class="block mb-2 text-sm font-medium  text-white">Publisher</label>
                        <input :value="publisher" type="text" name="publisher" id="publisher" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Publisher" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="year" class="block mb-2 text-sm font-medium  text-white">Year</label>
                        <input :value="year" type="number" name="year" id="year" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Year" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="isbn" class="block mb-2 text-sm font-medium  text-white">ISBN</label>
                        <input :value="isbn" type="number" name="isbn" id="isbn" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="ISBN" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="copies-total" class="block mb-2 text-sm font-medium  text-white">Copies Total</label>
                        <input :value="cTotal" type="number" name="copies_total" id="copies-total" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="copies total" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="copies-available" class="block mb-2 text-sm font-medium  text-white">Copies Available</label>
                        <input :value="cAvailable" type="number" name="copies_available" id="copies-available" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="copies available" required="" autocomplete="off">
                    </div>
                    <div x-data="{dropdown: false, selecteds: [],
                        addGenre(genre) {if(!this.selecteds.includes(genre)) {this.selecteds.push(genre)}},
                        removeGenre(genre) {this.selecteds = this.selecteds.filter(g => g !== genre)}
                    }" x-init="$watch('genres', value => {if (value.length > 0) {selecteds = value} else {selecteds = []}})" class="relative">
                        <input type="hidden" name="genres" :value="JSON.stringify(selecteds)">
                        <label for="genres" class="block mb-2 text-sm font-medium text-white">Genres</label>
                        <div tabindex="0" @keyup.enter.prevent="dropdown = !dropdown" @click="dropdown = !dropdown" class="relative overflow-x-scroll scrollbar-none border rounded-lg block h-[42px] w-full bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" required="" autocomplete="off">
                            <div  class="flex items-center h-full gap-2 absolute px-2">
                                <template x-for="selected in selecteds" :key="selected">
                                <div class="flex gap-2 items-end border rounded p-1.5">
                                    <span x-text="selected" class="text-gray-400 text-xs"></span>
                                    <button @click.stop = "removeGenre(selected);" class="z-10 w-4 hover:bg-gray-600 rounded">
                                        <img src="{{ $BASEURL }}/img/assets/close.png" class="w-4">
                                    </button>
                                </div>
                                </template>
                                
                            </div>
                        </div>
                        <div x-show="dropdown" @click.outside="dropdown = false"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95" class="absolute inset-x-0 z-10 mt-2 w-48 h-32 overflow-y-scroll scrollbar-none origin-top-right rounded-md bg-gray-800 border border-gray-700 py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                        
                            @foreach ($genres as $genre)
                            <div x-show="dropdown" @keydown.enter.prevent="dropdown = false; addGenre({{ json_encode($genre->name) }})" @click="dropdown = false; addGenre({{ json_encode($genre->name) }})" class="cursor-pointer px-4 py-2 text-sm text-white hover:bg-gray-900" role="menuitem" tabindex="0"">{{ $genre->name }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium  text-white">Description</label>
                        <textarea :value="description" type="" name="description" id="description" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="description" required="" autocomplete="off"></textarea>
                    </div>
                    <div x-data="{file: null, fileUrl: null, init() {this.$watch('foto', value => {this.fileUrl = value ? '{{ url("img/books") }}/' + value : null;}); this.fileUrl = this.foto ? '{{ url('img/books') }}/' + this.foto : null;}}" @keyup.enter.prevent="if(!file) {$refs.file.click()}" :tabindex="file ? '-1' : '0'" class="sm:col-span-2 relative">
                        <div x-bind:class="{'border-dashed border-4 border-blue-500': !file, 'border-solid border-4 border-green-500': file}" id="drop-area" class="w-full border-2 border-dashed border-gray-400 p-6 text-center sm:flex justify-around">
                            <div class="flex flex-col items-center justify-center">
                                <label @drop.prevent="file = $event.dataTransfer.files[0]; file && (fileUrl = URL.createObjectURL(file)); $refs.file.files = $event.dataTransfer.files" @dragover.prevent x-show="!file && !fileUrl" for="foto" class="text-xl font-medium text-white w-full h-full absolute z-10 flex inset-0 items-center justify-center">Foto</label>
                                <input x-ref="file" @change="file = $event.target.files[0]; file && (fileUrl = URL.createObjectURL(file));" accept="image/*" id="foto" name="foto" type="file" class="hidden"/>
                                <p class="text-white"> 
                                    <span x-show="file" x-text="file.name" class="text-blue-500 cursor-pointer"></span>
                                    <span x-show="!file && foto" x-text="foto" class="text-blue-500 cursor-pointer"></span>
                                </p>
                                <button x-show="file || fileUrl" @click="file = null; fileUrl = null; foto = null; $refs.file.value = ''" type="button" class="w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-700 z-10">Remove Image</button>
                            </div>
                            <img x-show="file || fileUrl" :src="file ? fileUrl : fileUrl" class="h-32 w-auto object-cover rounded-md" alt="Uploaded Image">
                        </div>
                    </div>
                </div>
                <button x-text="judulModal === 'tambah' ? 'Tambah Data Baru' : (judulModal === 'edit' ? 'Edit Data Baru' : '')" type="submit" class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                </button>
            </form>
        </x-modal>
        <x-delete-modal>
            <x-slot:message>Yakin ingin menghapus data ini?</x-slot>
            <form :action="'{{ route('book.destroy', '') }}/' + id" method="post">
        </x-delete-modal>
    </x-slot>
</x-table>