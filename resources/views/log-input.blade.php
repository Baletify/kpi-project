<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        @php 
        $currentYear = Carbon\Carbon::now()->year;
        $startYear = 2024; 
        $endYear = $currentYear + 2;
        @endphp
        <div class="p-2">
            <div class="px-1">
                <span class="font-medium text-gray-600 text-sm">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
            </div>
            <div class="px-1">
                <span class=" font-bold text-gray-600 text-2xl">LOG INPUT KPI</span>
            </div>
        </div>
        <form action="{{ url('/log-input') }}" method="GET">
           <input type="hidden" name="department" id="department" value="{{ $department_id = request()->query('department') }}">
        <div class="flex gap-x-2">
            <div class="my-2">
                <select name="month" id="month" class=" w-24 h-10 text-[12px]">
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
                <select name="year" id="year" class=" w-24 h-10 text-[12px]">
                    <option value="">-- Tahun --</option>
                    @for ($year = $startYear; $year <= $endYear; $year++)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="my-2">
                <button type="submit" class="rounded-md bg-blue-500 text-white p-2">Filter</button>
            </div>
        </div>
        </form>
        <table class="w-full bg-white">
            <tr>
                <th style="width: 7%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Dept</th>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Total Employee</th>
                <th style="width: 10%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Input</th>
                <th style="width: 10%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Checked</th>
                <th style="width: 10%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Approved</th>
            </tr>
            @php
            $i = 0;
            
        @endphp
        @forelse ($departments as $department)
        @php
            $i++;
        @endphp
        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}"> 
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px]">{{ $department->name}}</td>
            @php
                $totalEmployee = $countEmployees->first(function($item) use ($department) {
                    return $item->department_id == $department->id;
                });
                $acc = $actualCheckedCheck->first(function($item) use ($department) {
                    return $item->department_id == $department->id;
                });
                $ac = $actualChecked->first(function($item) use ($department) {
                    return $item->department_id == $department->id;
                });
                $afc = $actualFilledCheck->first(function($item) use ($department) {
                    return $item->department_id == $department->id;
                });
                
                $ap = $actualApproved->first(function($item) use ($department) {
                    return $item->department_id == $department->id;
                });
                
                $af = $actualFilled->first(function($item) use ($department) {
                    return $item->department_id == $department->id;
                });
                
                
            @endphp
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center">{{ $totalEmployee->total_employee }}</td>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center">
                {{ $af ? $af->input_by : '' }} | {{ $af ? $af->input_at : '' }}
            </td>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center">
                {{ $afc ? '' : ($af->checked_by ?? '') }} | {{ $afc ? '' : ($af->checked_at ?? '') }}
            </td>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center">
                {{ $ap ? ($af->approved_by ?? '') : '' }} | {{ $ap ? ($af->approved_at ?? '') : '' }}
            </td>
            @empty
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-[13px] text-center" colspan="5">No data available</td>
        </tr>

        @endforelse
    </table>
</div>

</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.3.0/pdfobject.min.js" integrity="sha512-Nr6NV16pWOefJbWJiT8SrmZwOomToo/84CNd0MN6DxhP5yk8UAoPUjNuBj9KyRYVpESUb14RTef7FKxLVA4WGQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>