<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="p-1">
            <span class="text-gray-600 font-bold text-lg">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
        </div>
        <div class="justify-center flex flex-col items-center">
            <div class="">
                <span class="text-gray-600 font-bold text-lg text-center">Key Performance Indicator</span>
            </div>
            <div class="">
                @php
                $year = \Carbon\Carbon::parse($actuals->first()->date)->year;
                @endphp
                <span class="text-gray-600 font-bold text-xs text-center">Periode: Semester {{ $actuals->first()->semester }} {{ $year }}</span>
            </div>
        </div>
        <div class="grid grid-cols-5 p-1">
            <div class="mx-1">
                <table class="table-auto w-full">
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">Dept</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->department }}</td>
                    </tr>
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">NIK</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->nik }}</td>
                    </tr>
                </table>
            </div>
            <div class="mx-1">
                <table class="table-auto w-full">
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">Nama</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">Posisi</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->occupation }}</td>
                    </tr>
                </table>
            </div>
            
        </div>
        <div class="mx-1">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2">No.</th>
                    <th style="width: 30%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >KPI</th>
                    <th style="width: 8%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >Periode Review</th>
                    <th style="width: 5%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >Unit</th>
                    <th style="width: 6%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >Bobot "%"</th>
                    <th style="width: 8%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2"></th>
                    <th style="width: 40%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" colspan="7">Target & Actual KPI</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2">Bobot Pencapaian</th>
                </tr>
                @php
                $currentMonth = \Carbon\Carbon::now()->month;
                $months = [];
            
                if ($currentMonth >= 2 && $currentMonth < 8) {
                    $months = [
                        '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', 
                        '05' => 'May', '06' => 'Jun'
                    ];
                } else {
                    $months = [
                        '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', 
                        '11' => 'Nov', '12' => 'Dec'
                    ];
                }
                @endphp
                <tr> @foreach ($months as $month)
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >{{ $month }}</th>
                    @endforeach
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >Total</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($targets as $target)
            
                <tr>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="5">{{ $target->code }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-3" rowspan="5">{{ $target->indicator }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $target->period }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $target->unit }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">
                        {{ $target->weighting }}
                    </td>
                </tr>
                
                <tr>
                    <td class="border-2 bg-blue-100  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Target</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">{{ $actual ? $actual->target : '' }}</td>
                    @endforeach
                    <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center bg-yellow-200" rowspan="4"></td>
                </tr>
                <tr>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Actual</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">{{ $actual ? $actual->actual : '' }}</td>
                    @endforeach
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                <tr>
                    <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">%</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">{{ $actual ? $actual->kpi_percentage : '' }}</td>
                    @endforeach
                    <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                <tr>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Rekaman</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center hover:underline">
                        @if ($actual)
                            @if ($actual->record_file)
                                <a href="{{ route('report.showFile', $actual->record_file) }}" target="_blank">Yes</a>
                            @else
                                No
                            @endif
                        @else
                            No
                        @endif
                    </td>
                    @endforeach
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>