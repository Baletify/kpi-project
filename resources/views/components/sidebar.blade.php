<div class="fixed left-0 top-0 w-64 h-full bg-gray-800 p-4">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-300">
        <img src="https://via.placeholder.com/150" alt="logo" class="w-12 h-12 rounded object-cover">
        <span class="text-lg font-bold text-gray-200 ml-3">Key Performance Indicator</span>
    </a>
    <ul class="mt-4">
        <li>
            <a href="{{ url('/dashboard') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-900">
                <i class="ri-dashboard-2-line text-3xl"></i>
                <span class="ml-3">Dashboard</span>
            </a>
        </li>
        {{-- <div x-data="{ open: false }" class="items-center">
            <button @click="open = !open" class="flex items-center justify-between w-full text-gray-200 font-bold px-7 py-2 hover:bg-gray-900 ">
                <span>Input Data</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <ul x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="mt-2 space-y-2"> --}}
                <li>
                    <a href="/target/input-target-kpi" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-900">
                        <i class="ri-focus-2-line text-3xl"></i>
                        <span class="ml-3">Input Target</span>
                    </a>
                </li>
                <li>    
                    <a href="/actual/input-actual-employee" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-900">
                        <i class="ri-book-2-line text-3xl"></i>
                        <span class="ml-3">Input Pencapaian Aktual</span>
                    </a>
                </li>
            {{-- </ul>
        </div> --}}
        <li>
            <a href="{{ url('/log-input') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-900">
                <i class="ri-history-line text-3xl"></i>
                <span class="ml-3">Log Input</span>
            </a>
        </li>
        <li>
            <a href="{{ url('report/department-report') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-900">
                <i class="ri-file-chart-line text-3xl"></i>
                <span class="ml-3">Laporan</span>
            </a>
        </li>
    </ul>
</div>