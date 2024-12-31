<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-60 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
    <form action="{{ route('notification.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-x-3">
            <div class="grid grid-cols-2 gap-x-3">
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Title</span>  
                    <input type="text" name="title" id="title" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Title" value="" autocomplete="off">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Author</span>  
                    <input type="text" name="author" id="author" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Author" value="{{ auth()->user()->name }}" autocomplete="off">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Isi Konten</span>  
                    <textarea name="content" id="content" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Your Content Here" rows="3"></textarea>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Departemen</span>  
                    <input type="text" name="department" id="department" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departmen" value="{{ $department->name }}" autocomplete="off">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
            </div>
            <div class="w-full rounded-md border-0 pr-20 text-gray-900  sm:text-sm sm:leading-6 mt-6 flex justify-center gap-x-6">
                <a href="{{ route('dashboard') }}">
                    <div class="mb-2">
                        <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md">Cancel</button>
                    </div>
                </a>
                <div class="mb-2">
                    <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</x-app-layout>

<script>
    document.getElementById('importForm').addEventListener('submit', function() {
        var submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Loading...'; // Optional: Show loading text
    });
</script>