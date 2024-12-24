<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        @php 
        $currentYear = Carbon\Carbon::now()->year;
        $startYear = 2024; 
        $endYear = $currentYear + 2;
        $department_id = request()->query('department');
        $monthQuery = request()->query('month');
        $date = DateTime::createFromFormat('!m', $monthQuery);
        $monthName = $date->format('F');
        function formatDate($dateString) {
        if ($dateString) {
            return Carbon\Carbon::parse($dateString)->format('d F Y H:i:s');
        }
        return '';
    } 
        @endphp
        <div class="flex justify-between">
            <div class="mb-2">
                <div class="px-1">
                    <span class="font-medium text-gray-600 text-sm">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
                </div>
                <div class="px-1">
                    <span class=" font-bold text-gray-600 text-2xl">LOG INPUT KPI</span>
                </div>
                <div class="px-1">
                    <span class=" font-semibold text-gray-600 text-sm">Bulan: {{ $monthName }}</span>
                </div>
            </div>
            <div class="flex justify-between">
                <div class="p-0 5">
                    <form action="{{ route('log-input.individual') }}" method="GET">
                     <div class="flex gap-x-2">
                         <div class="my-2">
                             <select name="month" id="month" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                 <option value="">-- Bulan --</option>
                                 <option value="01">January</option>
                                 <option value="02">February</option>
                                 <option value="03">March</option>
                                 <option value="04">April</option>
                                 <option value="05">May</option>
                                 <option value="06">June</option>
                                 <option value="07">July</option>
                                 <option value="08">August</option>
                                 <option value="09">September</option>
                                 <option value="10">October</option>
                                 <option value="11">November</option>
                                 <option value="12">December</option>
                             </select>
                         </div>
                         <div class="my-2">
                             <select name="year" id="year" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                 <option value="">-- Tahun --</option>
                                 @for ($year = $startYear; $year <= $endYear; $year++)
                                 <option value="{{ $year }}">{{ $year }}</option>
                                 @endfor
                             </select>
                         </div>
                         <div class="my-2">
                             <select name="department" id="department" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                 <option value="">-- Department --</option>
                                 @foreach ($department as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                    
                             </select>
                         </div> 
                         <div class="my-2">
                             <button type="submit" class="rounded-md bg-blue-500 text-white p-2">Filter</button>
                         </div>
                     </div>
                     </form>
                </div>
            </div>
        </div>
        
        
                   
        <table class="w-full bg-white">
            <tr>
                <th style="width: 7%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Dept</th>
                <th style="width: 28%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Name</th>
                <th style="width: 22%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Input</th>
                <th style="width: 22%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Checked</th>
                <th style="width: 22%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Approved</th>
            </tr>
            @php
            $i = 0;
            
        @endphp
        @forelse ($employees as $employee)
        @php
            $i++;
            $employeeInput = $employeesInput->firstWhere('id', $employee->id);
        @endphp
        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}"> 
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px]">{{ $employee->department}}</td>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px]">{{ $employee->name }}</td>

            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center">
                {{ $employeeInput ? $employeeInput->latest_input_at : '' }}
            </td>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center">

            </td>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center">
                {{ $employeeInput ? $employeeInput->latest_approved_at : '' }}
            </td>
            @empty
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center" colspan="5">No data available</td>
        </tr>

        @endforelse
    </table>
</div>

</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.3.0/pdfobject.min.js" integrity="sha512-Nr6NV16pWOefJbWJiT8SrmZwOomToo/84CNd0MN6DxhP5yk8UAoPUjNuBj9KyRYVpESUb14RTef7FKxLVA4WGQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
