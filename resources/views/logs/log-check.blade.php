<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-60 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="p-2">
            <div class="px-1">
                <span class="font-medium text-gray-600 text-sm">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
            </div>
            <div class="px-1">
                <span class=" font-bold text-gray-600 text-2xl">Log Pengecekan KPI</span>
            </div>
        </div>

        <table class="w-full bg-white table-fixed">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700" rowspan="2">Dept</th>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700" rowspan="2">Jumlah KPI</th>
                @foreach ($months as $month)
                    <th style="width: 10%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700" colspan="2">
                        {{ \Carbon\Carbon::create()->month($month)->format('M') }}
                    </th>
                @endforeach
            </tr>
            <tr>
                @foreach ($months as $month)
                    <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">OK</th>
                    <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Not OK</th>
                @endforeach
            </tr>

            @php
                $i = 0;
            @endphp
            @foreach ($departments as $department => $items)
                @php
                    $i++;
                    $targetCount = $targetCounts->where('code', $department)->first();
                    $targetCountDept = $targetCountsDept->where('code', $department)->first();
                   

                    $departmentId = $items->first()->department_id;
                @endphp
                <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}">
                    <td class="border-2 pl-1 border-gray-400 tracking-wide text-[11px] py-0">
                        <a href="{{ url('/report/list-employee-report?department=' . $departmentId) }}" class="hover:underline hover:text-blue-500">
                            {{ $department }}
                        </a>
                    </td>
                    <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0 text-center">
                        {{ ($targetCount ? $targetCount->total : 0) + ($targetCountDept ? $targetCountDept->total : 0) }}
                    </td>
                    @foreach ($months as $month)
                        @php
                            $item = $items->first(function($item) use ($month) {
                                return \Carbon\Carbon::parse($item->created_at)->month == $month;
                            });

                            $actualCount = collect($actualCounts)
                                ->where('department_code', $department)
                                ->where('month', $month)
                                ->first();
                            $actualCountDept = collect($actualCountsDept)
                                ->where('department_code', $department)
                                ->where('month', $month)
                                ->first();

                            
                            $currentMonth = \Carbon\Carbon::now()->month;
                            if ($currentMonth >= 2 && $currentMonth < 7) {
                                $targetUnitCounts = $targetUnitCounts1;
                                $targetUnitCountsDept = $targetUnitCountsDept1; 
                            } else {
                                $targetUnitCounts = $targetUnitCounts2;
                                $targetUnitCountsDept = $targetUnitCountsDept2; 
                            }

                            $targetColumn = 'total_' . $month;
                            $targetUnitCount = $targetUnitCounts->where('department_code', $department)->first();
                            $targetUnitCountDept = $targetUnitCountsDept->where('department_code', $department)->first();
                        @endphp
                        <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0 text-center">
                            {{ ($actualCount || $actualCountDept) ? (($actualCount ? $actualCount['total'] : 0) + ($actualCountDept ? $actualCountDept['total'] : 0)) : '' }}
                        </td>
                        <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0 text-center">
                            {{ ($targetUnitCount || $targetUnitCountDept) ? (($targetUnitCount ? $targetUnitCount->$targetColumn : 0) + ($targetUnitCountDept ? $targetUnitCountDept->$targetColumn : 0)) : '' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>