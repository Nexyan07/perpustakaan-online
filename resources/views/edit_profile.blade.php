<x-layout>
    <x-slot:titlePage>Perpustakaan - Profile</x-slot>
    <div x-data="{foto: '{{ $BASEURL }}/img/users/{{ Auth::user()->foto }}', defaultFoto: '{{ $BASEURL }}/img/users/default-profile.jpg', modal: false}" class="flex justify-center items-center min-h-screen">
      <div class="w-96 mx-auto bg-gray-800 rounded-xl border">
          <form action="{{ route('update.profile', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" class=" relative">
            @csrf
            @method('PUT')
                <a href="/profile" class="absolute inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 rounded-tl-xl text-sm px-5 py-4 text-center focus:ring-gray-900">
                  <img src="{{ $BASEURL }}/img/assets/back.png" class="w-4" alt="">
                </a>
              <button type="submit" class="absolute right-0 inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 rounded-tr-xl text-sm px-5 py-4 text-center focus:ring-gray-900">
                <img src="{{ $BASEURL }}/img/assets/check.png" class="w-4" alt="">
              </button>
            <div class="flex justify-center items-center mb-4">
                <div class="relative mt-8">
                  <template x-if="foto === defaultFoto">
                    <input type="hidden" name="fotoDefault" value="default-profile.jpg">
                  </template>
                  <input x-ref="foto" type="file" name="foto" id="foto" class="hidden" accept="image/*" @change="foto = URL.createObjectURL($event.target.files[0]);">
                  <img @click="foto === defaultFoto ? $refs.foto.click() : modal = true" :src="foto" alt="profile" class="cursor-pointer rounded-full w-32 shrink-0 h-32 object-cover">
                  <div class="absolute bg-gray-500 p-1 bottom-1 right-1 outline outline-2 outline-white rounded-full">
                    <img @click="foto === defaultFoto ? $refs.foto.click() : modal = true" :src="foto === defaultFoto ? '{{ $BASEURL }}/img/assets/camera.png' : '{{ $BASEURL }}/img/assets/bin.png'" alt="" class="cursor-pointer w-6 h-6 ">
                  </div>
                  <div x-show="modal & foto !== defaultFoto" @click.outside="modal = false"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-gray-800 border border-gray-700 py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                
                      <div @click="$refs.foto.click(); modal = false" class="cursor-pointer block px-4 py-2 text-sm text-white hover:bg-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Ganti Foto</div>
                      <div @click="foto = defaultFoto; modal = false" class="cursor-pointer block px-4 py-2 text-sm text-red-500 hover:bg-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-2">Hapus Foto</div>
                  </div>
                </div>
            </div>
            <div class="flex flex-col justify-center space-y-8 mx-10 mb-6">
              <input type="hidden" name="role" value="{{ Auth::user()->role }}">
                <div class="relative">
                    <input 
                      type="text" 
                      placeholder="Masukkan Nama" 
                      id="nama"
                      autocomplete="off"
                      value="{{ Auth::user()->name }}"
                      name="name"
                      class="border-0 border-b bg-gray-900 rounded border-white w-full text-sm px-3 py-2 peer placeholder-transparent 
                      focus:outline-none focus:ring-0 text-white">
                    
                    <label 
                      for="nama" 
                      class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white transition-all duration-200 
                             peer-focus:-translate-y-10 peer-focus:-translate-x-3 peer-focus:text-[0.8rem] 
                             peer-[&:not(:placeholder-shown)]:-translate-y-10 peer-[&:not(:placeholder-shown)]:-translate-x-3 
                             peer-[&:not(:placeholder-shown)]:text-[0.8rem]">
                      Nama
                    </label>
                </div>
                <div class="relative">
                    <input 
                      type="text" 
                      placeholder="Masukkan Email" 
                      id="email"
                      autocomplete="off"
                      value="{{ Auth::user()->email }}"
                      name="email"
                      class="border-0 border-b bg-gray-900 border-white w-full rounded text-sm px-3 py-2 peer placeholder-transparent 
                      focus:outline-none focus:ring-0 text-white">
                    
                    <label 
                      for="email" 
                      class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white transition-all duration-200 
                             peer-focus:-translate-y-10 peer-focus:-translate-x-3 peer-focus:text-[0.8rem] 
                             peer-[&:not(:placeholder-shown)]:-translate-y-10 peer-[&:not(:placeholder-shown)]:-translate-x-3 
                             peer-[&:not(:placeholder-shown)]:text-[0.8rem]">
                      Email
                    </label>
                </div>
                <div class="relative">
                    <input 
                      type="text" 
                      placeholder="Masukkan Nomor Telepon" 
                      id="telepon"
                      autocomplete="off"
                      value="{{ Auth::user()->telepon }}"
                      name="telepon"
                      class="border-0 border-b bg-gray-900 border-white w-full rounded text-sm px-3 py-2 peer placeholder-transparent 
                      focus:outline-none focus:ring-0 text-white">
                    
                    <label 
                      for="telepon" 
                      class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white transition-all duration-200 
                             peer-focus:-translate-y-10 peer-focus:-translate-x-3 peer-focus:text-[0.8rem] 
                             peer-[&:not(:placeholder-shown)]:-translate-y-10 peer-[&:not(:placeholder-shown)]:-translate-x-3 
                             peer-[&:not(:placeholder-shown)]:text-[0.8rem]">
                      Telepon
                    </label>
                </div>
                <div class="relative">
                    <input 
                      type="text" 
                      placeholder="Masukkan Alamat" 
                      id="alamat"
                      autocomplete="off"
                      value="{{ Auth::user()->address }}"
                      name="address"
                      class="border-0 border-b bg-gray-900 border-white w-full rounded text-sm px-3 py-2 peer placeholder-transparent 
                      focus:outline-none focus:ring-0 text-white">
                    
                    <label 
                      for="alamat" 
                      class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white transition-all duration-200 
                             peer-focus:-translate-y-10 peer-focus:-translate-x-3 peer-focus:text-[0.8rem] 
                             peer-[&:not(:placeholder-shown)]:-translate-y-10 peer-[&:not(:placeholder-shown)]:-translate-x-3 
                             peer-[&:not(:placeholder-shown)]:text-[0.8rem]">
                      Alamat
                    </label>
                </div>
                <div class="relative">
                    <a href="/validate-old-password">
                        <input 
                        type="text" 
                      id="password"
                      value="••••••••"
                      class="border-0 border-b bg-gray-950 border-white w-full rounded text-sm px-3 py-2 placeholder-transparent 
                      focus:outline-none focus:ring-0 text-white cursor-pointer">
                      <img src="{{ $BASEURL }}/img/assets/right-arrow.png" class="text-white absolute right-4 top-1/2 -translate-y-1/2 w-4">
                      <span class="absolute w-full h-full left-0 rounded inline-block"></span>
                    </a>
                    
                    <label 
                      for="password" 
                      class="absolute left-0 -top-5 text-white text-[0.8rem]">
                      Password
                    </label>
                </div>
            </div>
            </form>
        </div>
    </div>
</x-layout>