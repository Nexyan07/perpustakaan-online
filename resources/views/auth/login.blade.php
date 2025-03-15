<x-layout>
    <x-slot:titlePage>Perpustakaan - Login</x-slot>
    <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
        
        <div class="w-full bg-white rounded-lg shadow dark:border md:my-20 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-4 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                    Sign in
                </h1>
                <div class="flex justify-center">
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
                <form class="space-y-4" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off" placeholder="Name" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div x-data="{input: '', show: false}" class="relative">
                            <input x-model="input" :type="show ? 'text' : 'password'" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 pr-12 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••" required="">
                            <button x-show="input != ''" type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white" tabindex="-1">
                                <img x-show="!show" src="{{ $BASEURL }}/img/assets/show.png" alt="" class="size-6">
                                <img x-show="show" src="{{ $BASEURL }}/img/assets/hide.png" alt="" class="size-6">
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="text-white text-sm">Remember Me</label>
                    </div>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign up</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                        Don't have an account? <a href="/registration" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>

</x-layout>