<x-layout>
    <x-slot:titlePage>Change Password</x-slot>
    <div class="flex justify-center items-center min-h-screen">
        <div x-data="{focus: false, input:''}" class="w-96 mx-auto bg-gray-800 rounded-xl border">
            <a href="/edit-profile" class="absolute inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 rounded-tl-xl text-sm px-5 py-4 text-center focus:ring-gray-900">
                <img src="{{ $BASEURL }}/img/assets/back.png" class="w-4" alt="">
              </a>
            <div class="flex flex-col mt-14">
            <div class="flex justify-center mx-10">
                @if ($errors->any())
                <div class="w-full max-w-lg p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('status') == 'error')
                <div class="w-full max-w-lg p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ session('message') }}
                </div>
                @endif
            </div>
            <div class="ml-10 flex gap-4 items-center">
                <img src="{{ $BASEURL }}/img/users/{{ Auth::user()->foto }}" alt="" class="w-16 rounded-full">
                <div>
                    <div class="text-base/5 font-medium text-white">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

            <form action="{{ route('validate.password') }}" method="POST" class="">
                @csrf
            <div class="flex items-center justify-center h-full w-full">
                <div x-data="{show: false}" class="relative w-full mx-10 mb-5 transition-all" :class="focus | input != '' ? 'mt-8' : 'mt-2'">
                    <input 
                    @focus="focus = true"
                    @blur="focus = false"
                    x-model='input'
                    :type="show ? 'text' : 'password'"
                    name="old_password"
                    placeholder="" 
                    id="password"
                    autocomplete="off"
                    required
                    class="border-0 border-b bg-gray-900 rounded border-white w-full text-sm px-3 py-2 peer placeholder-transparent 
                    focus:outline-none focus:ring-0 text-white">
                    <button x-show="input != ''" type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white" tabindex="-1">
                        <img x-show="!show" src="{{ $BASEURL }}/img/assets/show.png" alt="" class="size-6">
                        <img x-show="show" src="{{ $BASEURL }}/img/assets/hide.png" alt="" class="size-6">
                    </button>
                
                <label 
                    for="password" 
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white transition-all duration-200 
                            peer-focus:-translate-y-10 peer-focus:-translate-x-3 peer-focus:text-[0.8rem] 
                            peer-[&:not(:placeholder-shown)]:-translate-y-10 peer-[&:not(:placeholder-shown)]:-translate-x-3 
                            peer-[&:not(:placeholder-shown)]:text-[0.8rem]">
                    Password lama
                </label>
            </div>
        </div>
        <div class="flex justify-end mr-10 mb-5">
            <button type="submit" class="justify-center inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 font-medium rounded-lg text-sm px-4 py-2.5 text-center focus:ring-primary-900">Selanjutnya</button>
        </div>
        </form>
        </div>
    </div>
</x-layout>