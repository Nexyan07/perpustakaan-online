@if (session('status'))
<div x-data="{showModal: true}">
  <div x-show="showModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center" x-cloak>
    <div @click.outside="showModal = !showModal" @keyup.enter.window="showModal = false" class="bg-gray-800 border rounded-lg shadow-lg p-6 w-96 relative">
      <div class="flex justify-between items-center mb-4">
        @if (session('status') === 'error')
        <h3 class="text-lg font-semibold text-red-500">
          Gagal
        </h3>
        @endif
        @if (session('status') === 'success')
        <h3 class="text-lg font-semibold text-green-300">
          Berhasil
        </h3>
        @endif
        <button @click="showModal = !showModal" class="text-white absolute right-0 top-0 px-2 rounded-tr-lg hover:bg-red-600">&times;</button>
      </div>
      <p class="text-white">{{ session('message') }}</p>
      @if ($errors->any())
      <ul class="mt-2">
          @foreach ($errors->all() as $error)
              <li class="text-white">{{ $error }}</li>
          @endforeach
      </ul>
      @endif
    </div>
  </div>
</div>
@endif