<x-table>
    <x-slot:section>
        <section x-data="{judulModal: '', id: '', foto: '', name: '', address: '', email: '', telepon: '', password: '', role: ''}" class="bg-gray-900 p-3 sm:p-5 antialiased">
    </x-slot>
    <x-slot:title>Users</x-slot>
    <x-slot:dataCount>{{ $users->count() }}</x-slot>
    <x-slot:form>
        <form action="{{ route('user.index') }}" method="GET" class="flex items-center">
    </x-slot>
    <x-slot:buttonTambah>
        <button @click="judulModal = 'tambah'; id= ''; foto=''; name=''; address=''; email = ''; telepon = ''; password = ''; role = '';" type="button" id="defaultModalButton" data-modal-target="formModal" data-modal-toggle="formModal" class="flex items-center justify-center text-white focus:ring-4 font-medium rounded-lg text-sm px-4 py-2 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-primary-800">
    </x-slot>
    <x-slot:pagination>{{ $users->links() }}</x-slot>
    <table class="w-full text-sm text-left text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
            <tr>
                <th scope="col" class="p-4">No</th>
                <th scope="col" class="p-4">Foto</th>
                <th scope="col" class="p-4">User</th>
                <th scope="col" class="p-4">address</th>
                <th scope="col" class="p-4">email</th>
                <th scope="col" class="p-4">telepon</th>
                <th scope="col" class="p-4">role</th>
                <th scope="col" class="p-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr class="border-b border-gray-600 hover:bg-gray-700">
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $loop->iteration }}</td>
                <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="flex items-center">
                        <a href="{{ $BASEURL }}/img/users/{{ $user->foto }}">
                            <img src="{{ $BASEURL }}/img/users/{{ $user->foto }}" alt="" class="h-8 w-auto">
                        </a>
                    </div>
                </td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $user->name }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $user->address }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $user->email }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $user->telepon }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">{{ $user->role }}</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white">
                    <div class="flex items-center space-x-4">
                        <button @click="judulModal = 'edit'; id = '{{ $user->id }}'; foto='{{ $user->foto }}'; name = '{{ $user->name }}'; address = '{{ $user->address }}'; email = '{{ $user->email }}'; telepon = '{{ $user->telepon }}'; password = '{{ Str::limit($user->password, 20, '') }}'; role = '{{ $user->role }}';" type="button" data-modal-target="formModal" data-modal-toggle="formModal" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                            Edit
                        </button>
                        <button @click="id = '{{ $user->id }}'" type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="flex items-center border focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-3 py-2 text-center border-red-500 text-red-500 hover:text-white hover:bg-red-600 focus:ring-red-900">
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
            <form :action="(judulModal === 'edit' && id) ? '{{ route('user.update', '') }}/' + id : '{{ route('user.store') }}'" method="post" enctype="multipart/form-data">
                @csrf
                <template x-if="judulModal == 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                        <input :value="name" type="text" name="name" id="name" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Nama" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-white">Address</label>
                        <input :value="address" type="text" name="address" id="address" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Alamat" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                        <input :value="email" type="email" name="email" id="email" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Email" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="telepon" class="block mb-2 text-sm font-medium text-white">Telepon</label>
                        <input :value="telepon" type="text" name="telepon" id="telepon" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Telepon" required="" autocomplete="off">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                        <div x-data="{input: '', show: false}" class="relative">
                            <input x-model="input" :value="password" :type="show ? 'text' : 'password'" name="password" id="password" class="border text-sm rounded-lg block w-full p-2.5 pr-12 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Password" required="" autocomplete="off">
                            <button x-show="input != ''" type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white" tabindex="-1">
                                <img x-show="!show" src="{{ $BASEURL }}/img/assets/show.png" alt="" class="size-6">
                                <img x-show="show" src="{{ $BASEURL }}/img/assets/hide.png" alt="" class="size-6">
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-white">Role</label>
                        <select name="role" id="role" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500">
                            <option selected>Pilih Role</option>
                            <option value="member" :selected="role == 'member'">Member</option>
                            <option value="admin" :selected="role == 'admin'">Admin</option>
                        </select>
                    </div>
                    <div x-data="{file: null, fileUrl: null, init() {this.$watch('foto', value => {this.fileUrl = value ? '{{ url("img/users") }}/' + value : null;}); this.fileUrl = this.foto ? '{{ url('img/users') }}/' + this.foto : null;}}" class="sm:col-span-2 relative">
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
            <form :action="'{{ route('user.destroy', '') }}/' + id" method="post">
        </x-delete-modal>
    </x-slot>
</x-table>