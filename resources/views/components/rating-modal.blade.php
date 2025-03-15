<div id="ratingModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div x-data="{rating: '', star1: false, star2: false, star3: false, star4: false, star5: false}" class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <form :action="'{{ route('rating', '') }}/' + book_id" method="post">
            @csrf
            <input type="hidden" name="rating" :value="rating">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button" @click="star1= false; star2= false; star3= false; star4= false; star5= false;" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="ratingModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="flex justify-center">
                    <div @click = "rating = 1; star1 = true; star2= false; star3= false; star4= false; star5= false">
                        <template x-if="star1">
                            @include('partials.yellowStar')
                        </template>
                        <template x-if="!star1">
                            @include('partials.star')
                        </template>
                    </div>
                    <div @click = "rating = 2; star1 = true; star2 = true; star3= false; star4= false; star5= false">
                        <template x-if="star2">
                            @include('partials.yellowStar')
                        </template>
                        <template x-if="!star2">
                            @include('partials.star')
                        </template>
                    </div>
                    <div @click = "rating = 3; star1 = true; star2 = true; star3 = true; star4= false; star5= false">
                        <template x-if="star3">
                            @include('partials.yellowStar')
                        </template>
                        <template x-if="!star3">
                            @include('partials.star')
                        </template>
                    </div>
                    <div @click = "rating = 4; star1 = true; star2 = true; star3 = true; star4 = true; star5= false">
                        <template x-if="star4">
                            @include('partials.yellowStar')
                        </template>
                        <template x-if="!star4">
                            @include('partials.star')
                        </template>
                    </div>
                    <div @click = "rating = 5; star1 = true; star2 = true; star3 = true; star4 = true; star5 = true">
                        <template x-if="star5">
                            @include('partials.yellowStar')
                        </template>
                        <template x-if="!star5">
                            @include('partials.star')
                        </template>
                    </div>
                </div>
                <p class="mt-4 text-gray-500 dark:text-gray-300">
                    <span x-show="!star1">Rating</span>
                    <span x-show="star1 & !star2">Terpantau buku asal jadi</span>
                    <span x-show="star2 & !star3">Baguskangi bukuna adekku</span>
                    <span x-show="star3 & !star4">Gini doang?</span>
                    <span x-show="star4 & !star5">Lumayan</span>
                    <span x-show="star5">Keren, best bet pokokna</span>
                </p>
                <div class="flex justify-center mt-4">
                    <button type="submit" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>