<div class="fixed left-0 top-0 w-64 h-full bg-[#0F1035] p-4">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-300">
        <img src="https://via.placeholder.com/150" alt="logo" class="w-12 h-12 rounded object-cover">
        <span class="text-lg font-bold text-gray-200 ml-3">Key Performance Indicator</span>
    </a>
    @php
    $currentMonth = now()->month;
    $currentYear = now()->year;
    $yearToShow = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
    @endphp
    <ul class="mt-4">
        <li>
            <a href="{{ url('/dashboard') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                <i class="ri-dashboard-2-line text-2xl"></i>
                <span class="ml-3">Dashboard</span>
            </a>
        </li>
        {{-- <div x-data="{ open: false }" class="items-center">
            <button @click="open = !open" class="flex items-center justify-between w-full text-gray-200 font-bold px-7 py-2 hover:bg-gray-700 ">
                <span>Input Data</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <ul x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="mt-2 space-y-2"> --}}
                <li>
                    <a href="{{ url('/target/input-target-department?department=1') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                        <i class="ri-crosshair-2-line text-2xl"></i>
                        <span class="ml-3">Input Target</span>
                    </a>
                </li>
                <li>    
                    <a href="{{ url('/actual/input-actual-department?department=1') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                        <i class="ri-book-2-line text-2xl"></i>
                        <span class="ml-3">Input Pencapaian Aktual</span>
                    </a>
                </li>
            {{-- </ul>
        </div> --}}
        {{-- <li>
            <a href="{{ url('/action-plan/action-plans') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                <i class="ri-todo-line text-2xl"></i>
                <span class="ml-3">Action Plan</span>
            </a>
        </li> --}}
         <div x-data="{ open: false }" class="items-center">
            <button @click="open = !open" class="flex items-center w-full justify-between text-gray-200 px-4 py-2 hover:bg-gray-700 ">
                {{-- <i class="ri-history-line text-2xl"></i> --}}
                <span class="ml-3">Logs</span>
                <i class="ri-arrow-down-wide-line ml-20 ont-bold"></i>
            </button>
            <ul x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="mt-2 space-y-2">
                <li>
                    <a href="{{ url('/logs/log-check?year=' . $yearToShow) }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                        <i class="ri-file-check-line text-2xl"></i>
                        <span class="ml-3">Log Pengecekan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logs/log-input?department=1&month=' . $currentMonth - 1 . '&year=2024') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                        <i class="ri-history-line text-2xl"></i>
                        <span class="ml-3">Log Input</span>
                    </a>
                </li>             
                <li>
                    <a href="{{ url('/logs/log-input-individual?department=1&month=' . $currentMonth - 1 . '&year=2024') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                        <i class="ri-user-follow-fill text-2xl"></i>
                        <span class="ml-3">Log Input Individual</span>
                    </a>
                </li>             
            </ul>
        </div>
        <li>
            <div x-data="{ open: false }" class="items-center">
                <button @click="open = !open" class="flex items-center w-full justify-between text-gray-200 px-4 py-2 hover:bg-gray-700 ">
                    {{-- <i class="ri-pie-chart-line text-2xl"></i> --}}
                    <span class="ml-3">Summaries</span>
                    <i class="ri-arrow-down-wide-line ml-9 ont-bold"></i>
                </button>
                <ul x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="mt-2 space-y-2">
                    <li>
                        <a href="{{ url('report/summary-department-report?year=' . $yearToShow) }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                            <i class="ri-team-line text-2xl"></i>
                            <span class="ml-3">Summary Dept</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/report/list-employee-report?department=1') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                            <i class="ri-contacts-book-2-line text-2xl"></i>
                            <span class="ml-3">Summary KPI Employee</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/report/department-report/1?semester=2&year=2024') }}" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700">
                            <i class="ri-file-list-3-fill text-2xl"></i>
                            <span class="ml-3">Summary KPI Dept</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
    </ul>
</div>