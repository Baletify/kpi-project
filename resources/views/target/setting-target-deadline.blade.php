<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <form id="importForm" action="{{ route('target.updateTargetDeadline') }}" method="POST">
            @csrf
            @method('PUT')
        <div class="p-1 flex justify-center">
            <div class="mt-1 rounded-md border">
                <div class="flex justify-center ">
                    <span class="font-semibold">Tambah Batas Penginputan Target KPI</span>
                </div>
              <div class="mb-4 mt-2 flex justify-beetwen gap-x-2 px-2">
                <input type="text" id="start_date" name="start_date" 
                   class="border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-300 focus:outline-none" placeholder="{{ $startDate }}">
                <input type="text" id="end_date" name="end_date" 
                   class="border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-300 focus:outline-none" placeholder="{{ $endDate }}">
                <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
                </div>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
        </div>
        </form>

        <div class="flex justify-center">
            <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md" onclick="history.back();">
                Back
            </button>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.getElementById('importForm').addEventListener('submit', function() {
            var submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Loading...'; // Optional: Show loading text
        });

        document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#start_date", {
            enableTime: false, // Set to true if you want time selection
            dateFormat: "d-m-Y", // Format: DD-MM-YYYY
        });
        flatpickr("#end_date", {
            enableTime: false, // Set to true if you want time selection
            dateFormat: "d-m-Y", // Format: DD-MM-YYYY
        });
    });
    </script>
</x-app-layout>