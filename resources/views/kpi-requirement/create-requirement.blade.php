<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <form id="importForm" action="{{ route('requirement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="p-1 flex justify-center">
            <div class="mt-1 rounded-md border">
                <div class="">
                    <span class="mx-20 font-semibold">Upload Target KPI</span>  
                </div>
                <div class="flex justify-center">
                    <span class="text-xs text-red-500">*</span>  
                  <span class="text-xs">Format .pdf</span> 
                </div>
              <input type="file" name="file" id="file" class=" w-60 rounded-sm border-0 ml-7 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2 mb-3" placeholder="Departemen">
              <div class="p-0 flex justify-center mb-2">
                <select name="status" id="status" class="appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option value="">-- Jenis Dokumen --</option>
                    <option value="Standard">Standar KPI</option>
                    <option value="Tutorial">Cara Penggunaan Aplikasi KPI</option>
                  </select>
              </div>
              <div class="mb-2 mt-0 flex justify-center">
                <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
                </div>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
        </div>
        </form>
    </div>

    <script>
        document.getElementById('importForm').addEventListener('submit', function() {
            var submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Loading...'; // Optional: Show loading text
        });
    </script>
</x-app-layout>