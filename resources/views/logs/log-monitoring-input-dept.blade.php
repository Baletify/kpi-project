<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        @php
        $currentYear = date('Y');
        $startYear = 2024; 
        $endYear = $currentYear + 2;
        $yearQuery = request()->query('year');
        $semesterQuery = request()->query('semester');

        @endphp
    <div class="flex justify-between">
        <div class="flex justify-between">
            <p class="text-2xl font-bold">Log Input Data Aktual KPI Departemen</p>
        </div>
        <form action="{{ route('log-input.monitoringDept') }}" method="GET">
            <div class="flex">
                <div class="mt-2 mx-2">
                    <select name="semester" id="semester" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="{{ $semesterQuery }}">-- Semester --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="mt-2 mx-2">
                    <select name="year" id="year" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="{{ $yearQuery }}">-- Tahun --</option>
                        @for ($year = $startYear; $year <= $endYear; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="rounded-md">
                    <button class="py-2 px-2 bg-blue-600 my-2 rounded-md text-white">
                        Filter
                    </button>
                </div>
            </div>

    </div>
    </form>
    <div class="flex justify-end">
        <div class="mt-2">
            <button id="exportBtn" class="p-1.5 rounded-md text-white bg-green-500">Export</button>
        </div>
    </div>

    <div class="mt-3">
        @php
        $semester = request()->query('semester');
        if ($semester == '1') {
            $months = [
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'May',
            '6' => 'Jun',
            ];
        } else {
            $months = [
            '7' => 'Jul',
            '8' => 'Aug',
            '9' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
            ];
        }

        $i = 0;

        @endphp
        <table id="exportTable" class="w-full table-auto">
            <tr class="bg-blue-500">
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700 text-center" rowspan="2">No</th>
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" style="width: 10%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2">Dept</th>
                @foreach ($months as $item => $monthName)    
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" style="width: 15%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" colspan="3">{{ $monthName }}</th>
                @endforeach
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" style="width: 6%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" colspan="3">Total</th>
            </tr>
            <tr class="bg-blue-500">
                @foreach ($months as $item)    
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" data-a-text-rotation="90" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700 vertical-rl">
                    <p class="rotate-180 break-words"> Total KPI {{ "(Target)" }}</p>
                </th>
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" data-a-text-rotation="90" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700 vertical-rl">
                    <p class="rotate-180 break-words max-h-32">KPI yang sudah diinput data aktual + data pendukung</p>
                </th>
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700">%</th>
                @endforeach
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" data-a-text-rotation="90" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700 vertical-rl ">
                    <p class="rotate-180 break-words"> Total KPI {{ "(Target)" }}</p>
                </th>
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" data-a-text-rotation="90" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700 vertical-rl">
                    <p class="rotate-180 break-words max-h-32">Total KPI yang sudah diinput data aktual + data pendukung</p>
                </th>
                <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="FF0066FF" data-f-color="FFFFFFFF" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700">%</th>
            </tr>
            @foreach ($departments as $department)
            @php
                $i++;
                $sumTarget = 0;
                $sumActual = 0;
                $sumPercentage = 0;
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-blue-100' : 'bg-gray-50' }}">
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5">{{ $i }}</td>
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5">{{ $department->name }}</td>
                @foreach ($months as $month => $monthName)
                    @php
                        $target = $totalTarget->first(function($item) use ($department){
                            return $item->department_id == $department->id;
                        });
                        $targetColumn = 'total_'.$month;
                            // Debugging output
                        // dd($totalTarget, $departments, $target ?? 0, $employee->id);

                        $totalActual = $actuals->first(function($item) use ($month, $department){
                            return $item->month == $month && $item->department_id == $department->id;
                        });

                        $percentage = ($target->$targetColumn ?? 0) > 0 ? ($totalActual->total ?? 0) / $target->$targetColumn * 100 : 0;
                        $sumTarget += $target->$targetColumn ?? 0;
                        $sumActual += $totalActual->total ?? 0;
                    @endphp
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $target->$targetColumn ?? '' }}</td>
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $totalActual->total ?? '' }}</td>
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $percentage > 0 ? number_format($percentage, 1) . '%' : '' }}</td>
                @endforeach
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $sumTarget > 0 ? $sumTarget : '' }}</td>
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $sumActual > 0 ? $sumActual : '' }}</td>
                @php
                $avgPercentage = $sumTarget > 0 && $sumActual > 0 ? $sumActual / $sumTarget * 100 : 0;
                @endphp
                <td data-b-a-s="thin" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? 'FFF2F2F2' : 'FFFFFFFF' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $avgPercentage > 0 ? number_format($avgPercentage, 1) . '%' : '' }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>
</x-app-layout>

<script type="text/javascript" src="{{ asset('js/tableToExcel.js') }}"></script>
<script>
    let exportBtn = document.getElementById('exportBtn');
    exportBtn.addEventListener("click", e => {
        TableToExcel.convert(document.getElementById("exportTable"), {
        name: "log-input-aktual-dept.xlsx",
        sheet: {
            name: "Log Input Aktual Dept"
        }
        });
    })
</script>