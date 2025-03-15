<x-table>
    <x-slot:section>
        <section x-data="{judulModal: '', id: '', user: '', book:'', rating: ''}" class="bg-gray-900 p-3 sm:p-5 antialiased">
    </x-slot>
    <x-slot:title>Rating</x-slot>
    <x-slot:dataCount>{{ $ratings->count() }}</x-slot>
    <x-slot:form>
        <form action="{{ route('rating.index') }}" method="GET" class="flex items-center">
    </x-slot>
    <x-slot:buttonTambah>
        <button @click="judulModal = 'tambah'; id = ''; user = ''; book = ''; rating = '';" type="button" id="defaultModalButton" data-modal-target="formModal" data-modal-toggle="formModal" class="flex items-center justify-center text-white focus:ring-4 font-medium rounded-lg text-sm px-4 py-2 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
    </x-slot>
    <x-slot:pagination>{{ $ratings->links() }}</x-slot>
    <table class="w-full text-sm text-left text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
            <tr>
                <th scope="col" class="p-4">No</th>
                <th scope="col" class="p-4">User</th>
                <th scope="col" class="p-4">Buku</th>
                <th scope="col" class="p-4">Rating</th>
                <th scope="col" class="p-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ratings as $rating)
            <tr class="border-b border-gray-600 hover:bg-gray-700">
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $rating->user->name }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $rating->book->title }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $rating->rating }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">
                    <div class="flex items-center space-x-4">
                        <button @click="judulModal = 'edit'; id='{{ $rating->id }}'; user='{{ $rating->user->name }}'; book = '{{ $rating->book->title }}'; rating = '{{ $rating->rating }}';" type="button" data-modal-target="formModal" data-modal-toggle="formModal" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                            Edit
                        </button>
                        <button @click="id = {{ $rating->id }}" type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="flex items-center border focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-3 py-2 text-center border-red-500 text-red-500 hover:text-white hover:bg-red-600 focus:ring-red-900">
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
            <form :action="(judulModal === 'edit' && id) ? '{{ route('rating.update', '') }}/' + id : '{{ route('rating.store') }}'" method="post">
                @csrf
                <template x-if="judulModal == 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="users" class="block mb-2 text-sm font-medium text-white">users</label>
                        <select name="users" id="users" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500">
                            <option value="" :selected="user == ''">Pilih User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" :selected="user == '{{ $user->name }}'">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="books" class="block mb-2 text-sm font-medium text-white">Books</label>
                        <select name="books" id="books" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500">
                            <option value="" :selected="book == ''">Pilih Buku</option>
                            @foreach ($books as $book)
                            <option value="{{ $book->id }}" :selected="book == '{{ $book->title }}'">{{ $book->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="rating" class="block mb-2 text-sm font-medium text-white">Rating</label>
                        <input :value="rating" type="text" name="rating" id="rating" class=" border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Nama rating" required="" autocomplete="off">
                    </div>
                </div>
                <button x-text="judulModal === 'tambah' ? 'Tambah Data Baru' : (judulModal === 'edit' ? 'Edit Data Baru' : '')" type="submit" class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                </button>
            </form>
        </x-modal>

        <x-delete-modal>
            <x-slot:message>Yakin ingin menghapus data ini?</x-slot>
            <form :action="'{{ route('rating.destroy', '') }}/' + id" method="post">
        </x-delete-modal>
    </x-slot>
</x-table>