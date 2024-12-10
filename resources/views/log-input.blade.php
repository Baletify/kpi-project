<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        @php 
        $currentYear = Carbon\Carbon::now()->year;
        $startYear = 2024; 
        $endYear = $currentYear + 2;
        $department_id = request()->query('department')
        @endphp
        <div class="p-2">
            <div class="px-1">
                <span class="font-medium text-gray-600 text-sm">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
            </div>
            <div class="px-1">
                <span class=" font-bold text-gray-600 text-2xl">LOG INPUT KPI</span>
            </div>
        </div>
        
        <div class="flex justify-between">
            <div class="p-0 5">
                <form action="{{ url('/log-input') }}" method="GET">
                    <input type="hidden" name="department" id="department" value="{{ $department_id }}">
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
            </div>
            @php
            // dd($targetUnitCountAll);
            $monthQuery = request()->query('month');
                switch ($monthQuery) {
                    case '01':
                        $totalTgUnit = $targetUnitCountAll->total_1 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_1 ?? 0;
                        break;

                    case '02':
                        $totalTgUnit = $targetUnitCountAll->total_2 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_2 ?? 0;
                        break;

                    case '03':
                        $totalTgUnit = $targetUnitCountAll->total_3 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_4 ?? 0;
                        break;

                    case '04':
                        $totalTgUnit = $targetUnitCountAll->total_4 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_4 ?? 0;
                        break;

                    case '05':
                        $totalTgUnit = $targetUnitCountAll->total_5 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_5 ?? 0;
                        break;
                        
                    case '06':
                        $totalTgUnit = $targetUnitCountAll->total_6 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_6 ?? 0;
                        break;

                    case '07':
                        $totalTgUnit = $targetUnitCountAll->total_7 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_7 ?? 0;
                        break; 

                    case '08':
                        $totalTgUnit = $targetUnitCountAll->total_8 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_8 ?? 0;
                        break;

                    case '09':
                        $totalTgUnit = $targetUnitCountAll->total_9 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_9 ?? 0;
                        break;

                    case '10':
                        $totalTgUnit = $targetUnitCountAll->total_10 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_10 ?? 0;
                        break;

                    case '11':
                        $totalTgUnit = $targetUnitCountAll->total_11 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_11 ?? 0;
                        break;

                    case '12':
                        $totalTgUnit = $targetUnitCountAll->total_12 ?? 0;
                        $totalTgUnitDept = $targetUnitCountAllDept->total_12 ?? 0;
                        break;
                    default:
                        $totalTgUnit = 0;
                        $totalTgUnitDept = 0;
                        break;
                }

                $totalFl = $actualFilledCount->total_filled ?? 0;
                $totalFlDept = $actualFilledCountDept->total_filled ?? 0;
                $totalFlAll = $totalFl + $totalFlDept;
                $month = request()->query('month');
                $year = request()->query('year');
                $totalTgAll = $totalTgUnit + $totalTgUnitDept;

                // dd($totalFlAll, $totalTgAll);
                
                // dd('total filled:', $totalFl, 'total filled dept:', $totalFlDept, 'total filled dept and indiv', $totalFlAll, 'total target Unit dept + indiv', $totalTgAll);
                
            @endphp
            <div class="p-0.5">
                @if ($totalFlAll == $totalTgAll - 1 )
                <form action="{{ url('/generate-pdf-input') }}" method="GET">
                    @php
                        $lastInput = $actualFilled->first(function($item) use ($department_id) {
                            return $item->department_id == $department_id;
                        });

                        
                    @endphp
                    <input type="hidden" name="department_id" id="department_id" value="{{ $department_id }}">
                    <input type="hidden" name="input_at" id="input_at" value="{{ $lastInput->input_at }}">
                    <button type="submit" class="rounded-md bg-green-700 text-white p-2">Generate TTE</button>
                </form>
                @endif
            </div>
        </div>
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
                @if ($totalFlAll == $totalTgAll)
                {{ $af ? $af->input_by : '' }} | {{ $af ? $af->input_at : '' }}
                @endif
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
