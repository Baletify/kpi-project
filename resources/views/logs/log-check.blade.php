<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-60 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        @php
         $currentYear = Carbon\Carbon::now()->year;
             $startYear = 2024; 
             $endYear = $currentYear + 2;
             $semesterQuery = request()->query('semester');
            
        @endphp
    <div class="flex justify-between">
        <div class="p-2">
            <div class="px-1">
                <span class="font-medium text-gray-600 text-sm">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
            </div>
            <div class="px-1">
                <span class=" font-bold text-gray-600 text-2xl">Log Pengecekan KPI</span>
            </div>
        </div>
        <form action="{{ route('log-check.index') }}">
        <div class="p-0 flex gap-2">
            <div class="my-2">
                <select name="semester" id="semester" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option value="">-- Semester --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
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
                <button type="submit" class="rounded-md bg-blue-500 text-white p-2">Filter</button>
            </div>
        </div>
    </form>
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
                        <a href="{{ route('report.index', 'department=' . $departmentId) }}" class="hover:underline hover:text-blue-500">
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
                            if ($semesterQuery == '1') {
                                $targetUnitCounts = $targetUnitCounts1;
                                $targetUnitCountsDept = $targetUnitCountsDept1; 
                            } else {
                                $targetUnitCounts = $targetUnitCounts2;
                                $targetUnitCountsDept = $targetUnitCountsDept2; 
                            }

                            $targetColumn = 'total_' . $month;
                            $targetUnitCount = $targetUnitCounts->where('department_code', $department)->first();
                            $targetUnitCountDept = $targetUnitCountsDept->where('department_code', $department)->first();

                            $totalActual = ($actualCount['total'] ?? 0) + ($actualCountDept['total'] ?? 0);

                            // dd($totalActual);
                            
                        @endphp
                        <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0 text-center">
                            {{ $actualCount || $actualCountDept ? $totalActual : ''}}
                        </td>
                        <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0 text-center">
                            @if ($targetUnitCount || $targetUnitCountDept)
                                {{ ($targetUnitCount ? $targetUnitCount->$targetColumn : 0) + ($targetUnitCountDept ? $targetUnitCountDept->$targetColumn : 0) - ($totalActual ?? 0) }}
                            @else
                                <span></span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>