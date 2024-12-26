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
                <table class="table-auto w-full" data-cols-width="70,15,10">
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
            <div class="bg-gray-100">
                
            </div>
            <div class="bg-gray-100">
                
            </div>
            <div class="bg-gray-100">
                <div class="flex justify-end">
                    <div class="relative mt-0 rounded-md">
                        <form action="{{ route('report.show', $actuals->first()->employee_id) }}" method="GET">
                            <input type="hidden" name="year" id="year" value="{{ $year }}">
                        <div class="mt-2 mx-2">
                            <select name="semester" id="semester" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="">-- Semester --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center">
                        </div>
                      </div>
                      <div class="rounded-md">
                        <button class="py-2 px-2 bg-blue-600 my-2 rounded-md text-white">
                            Filter
                        </button>
                    </div>
                    </form>
                    <div class="mt-2 mx-2">
                        <button id="exportBtn" class="p-1.5 rounded-md text-white bg-green-500">Export</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="mx-1">
        <table id="exportTable" class="w-full table-auto">
            <thead>
                <tr >
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2">No. KPI</th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 25%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >KPI</th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 3%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Trend</th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Periode Review</th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 3%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Unit</th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Bobot "%"</th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 6%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2"></th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 40%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" colspan="7">Target & Actual KPI</th>
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2">Bobot Pencapaian</th>
                </tr>
                @php
                $months = [];
                $selectedSemester = $actuals->first()->semester;
            
                if ($selectedSemester == 1) {
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
                <tr> 
                    @foreach ($months as $month)
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 7%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" >{{ $month }}</th>
                    @endforeach
                    <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 7%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" >Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $sumTotalWeightingAchievement = 0;
                @endphp
                @foreach ($targets as $target)
                @php
                    $i++;
                @endphp
                <tr class="{{ $i % 2 === 0 ? 'bg-gray-50' : 'bg-blue-100' }}">
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="4">{{ $target->code }}</td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-3" rowspan="4">{{ $target->indicator }}</td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-3" rowspan="4">{{ $target->trend }}</td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4">{{ $target->period }}</td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4">{{ $target->unit }}</td> 
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4">
                        {{ $target->weighting }}
                    </td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">Target</td>
                    @foreach ($months as $month => $monthName)
                @php
                    $actual = $actuals->first(function($item) use ($target, $month) {
                        return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_code == $target->code;
                    });
                @endphp
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $actual ? $actual->target : '' }} </td>
                    @endforeach
                    
                    @php
                        $totalTarget = $totals[$target->code]['total_target'] ?? 0;
                    @endphp
                @if ($totalTarget > 0)
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                        @if ($target->unit === '%')
                            {{ $totalTarget }}%
                        @else
                            {{ $totalTarget }}
                        @endif
                     </td>
                 @else
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                    @php
                        $totalWeightingAchievement = $totals[$target->code]['total_achievement_weight'] ?? 0;
                        $sumTotalWeightingAchievement += $totalWeightingAchievement;
                    @endphp


                     @if ($totalWeightingAchievement > 0)
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4">{{ number_format($totalWeightingAchievement, 1) }}%</td>
                    @else
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4"></td>
                    @endif
                </tr>
                <tr>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">Actual</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_code == $target->code;
                        });
                    @endphp
                    
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                    {{ $actual ? $actual->actual : ''}}
                    </td>
                    @endforeach

                    @php
                         $totalActual = $totals[$target->code]['total_actual'] ?? 0;
                    @endphp
                    @if ($totalTarget > 0)
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                        @if ($target->unit === '%')
                        {{ $totalActual }}%
                        @else
                        {{ $totalActual }}
                        @endif
                     </td>
                 @else
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                </tr>
                <tr>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">%</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_code == $target->code;
                        });
                    @endphp
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $actual ? $actual->kpi_percentage : '' }}</td>
                    @endforeach
                    @php
                         $totalPercentage = $totals[$target->code]['total_percentage'] ?? 0;
                    @endphp
                    @if ($totalTarget > 0)
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ number_format($totalPercentage) }}%</td>
                 @else
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                </tr>
                <tr>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">Rekaman</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_code == $target->code;
                        });
                    @endphp
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center hover:underline">
                        @if ($actual)
                            @if ($actual->record_file)
                            @php
                            $modalId = 'modal-' . $actual->actual_id;
                            $buttonId = 'open-modal-' . $actual->actual_id;
                            $backgroundId = 'modal-background-' . $actual->actual_id;
                            $date = \Carbon\Carbon::parse($actual->date); // Parse the date
                            $prevButtonId = 'prevButton-' . $actual->actual_id;
                            $nextButtonId = 'nextButton-' . $actual->actual_id;
                            $pdfObjectId = 'pdfObject-' . $actual->actual_id;
                        @endphp
                            <button id="{{ $buttonId }}" class="hover:underline" data-month="{{ $date->format('m') }}" data-actual-id="{{ $actual->actual_id }}">
                                @if ($actual->status == 'Approved')
                                <span class="text-green-500">Yes</span>
                                @elseif ($actual->status == 'Checked')
                                <span class="text-blue-500">Review</span>
                                @elseif ($actual->status == 'Filled')
                                <span class="text-yellow-500">Check</span>
                                @endif
                            </button>

                            {{-- MODAL STARTS --}}
                            <div id="{{ $backgroundId }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden exclude-from-export"></div>
                            <div id="{{ $modalId }}" class="modal fixed mt-2 inset-0 justify-center hidden exclude-from-export" data-month="{{ $date->format('m') }}">
                                <div class="flex justify-center">
                                    <div class="bg-gray-50 rounded-lg shadow-lg px-4 py-2 w-1/2 max-h-screen overflow-y-hidden">
                                    <div class="flex flex-col">
                                        <h2 class="text-lg font-bold mb-0.5">Review Data Pendukung</h2>
                                        <span class="text-[12px] tracking-wide font-medium text-gray-600 mb-0.5">Bulan: {{ $monthName }}</span>
                                        <div class="">
                                            <span id="fileNumber-modal-{{ $actual->actual_id }}" class="text-[12px] tracking-wide font-medium text-gray-600 mb-1"></span>
                                        </div>
                                    </div>
                                    <div class="p-1 flex justify-between">
                                        <button id="{{ $prevButtonId }}" class="bg-blue-500 text-white p-2 text-[12px] rounded">Previous</button>
                                        <button id="{{ $nextButtonId }}" class="bg-blue-500 text-white p-2 text-[12px] rounded">Next</button>
                                    </div>
                                    <div id="pdfViewer" class="mt-1">
                                        <object id="{{ $pdfObjectId }}" type="application/pdf" width="100%" height="370px"></object>
                                    </div>
                                    <div id="checkbox-container-{{ $modalId }}" class="p-1 flex justify-center gap-3 mt-0.5">
                                        <label class="text-[14px]">
                                            <input type="checkbox" class="status-checkbox" data-actual-id="{{ $actual->actual_id }}" data-status="Checked" {{ $actual->status == 'Checked' || $actual->status == 'Approved' ? 'checked' : '' }} {{ auth()->user()->role == 'Checker Div 1' || auth()->user()->role == 'Checker Div 2' || auth()->user()->role == 'Checker WS' ? '' : 'disabled' }}>
                                            Check
                                        </label>
                                        <label class="text-[14px]">
                                            <input type="checkbox" class="status-checkbox" data-actual-id="{{ $actual->actual_id }}" data-status="Approved" {{ $actual->status == 'Approved' ? 'checked' : '' }} {{ auth()->user()->role == 'Approver' ? '' : 'disabled' }}>
                                            Approve
                                        </label>
                                        {{-- <button id="confirmRequest" class="button bg-blue-500 rounded-md text-white p-0.5 mt-1">Confirm</button> --}}
                                    </div>
                                    @if ($actual->status !== 'Approved')
                                    <div class="p-1 flex justify-start">
                                        <span class="text-semibold mb-1 text-[12px]">Berikan Komentar</span>
                                    </div>
                                    <div class="p-0 mb-2 flex justify-center">
                                        <textarea name="comment" id="comment" cols="58" rows="2"></textarea>
                                    </div>
                                    <div class="flex justify-center gap-3">
                                        
                                        <div class="flex flex-col">
                                            <button class="bg-yellow-500 text-white px-4 py-2 rounded text-[12px] mb-3">
                                                <i class="ri-send-plane-line"></i>
                                                <span>Kirim Revisi</span>
                                            </button>
                                            
                                        </div>
                                        
                                    </div>
                                    @endif
                                    
                                    <div class="flex justify-end">
                                        <button id="close-modal-{{ $modalId }}" class="bg-red-500 text-white px-4 py-2 rounded mr-2 text-[12px] mt-0.5">Close</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            @else
                            <span class="text-red-500">No</span>
                            @endif
                        @else
                            <span></span>
                        @endif
                        {{-- MODAL ENDS --}}
                    </td>
                    @endforeach
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"><span></span></td>
                </tr>
                @endforeach
                <tr>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#fff2f2f2" class="border-2 bg-blue-500 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0 px-0.5 text-center" colspan="5">Total</td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#fff2f2f2" class="border-2 bg-blue-500 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0 px-0.5 text-center">{{ $sumWeighting }}%</td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#fff2f2f2" class="border-2 bg-blue-500 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0 px-0.5 text-center" colspan="8"></td>
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#fff2f2f2" class="border-2 bg-blue-500 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0 px-0.5 text-center" colspan="1">{{ number_format($sumTotalWeightingAchievement, 1) }}%</td>

                </tr>
            </tbody>
        </table>
    </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/tableToExcel.js') }}"></script>
    <script src="https://unpkg.com/pdfobject"></script>


<script>
let pdfData = {}; // Dictionary to store pdfUrls for each modal
let currentIndexes = {}; // Dictionary to store currentIndex for each modal
let modalOrder = {}; // Dictionary to store the order of modals for each month

// Collect modal data based on month
document.querySelectorAll('.modal').forEach(modal => {
    const month = modal.dataset.month;
    const actualId = modal.id.split('-').pop();
    
    
    if (!modalOrder[month]) {
        modalOrder[month] = [];
    }
    modalOrder[month].push(actualId);
});

document.querySelectorAll('button[id^="open-modal-"]').forEach(button => {
    button.addEventListener('click', function() {
        const month = this.dataset.month;
        const actualId = this.dataset.actualId;
        fetchPdfUrls(month, actualId, this.id);
    });
});

document.querySelectorAll('button[id^="close-modal-"]').forEach(button => {
    button.addEventListener('click', function() {
        const actualId = this.id.split('-').pop();
        document.getElementById(`modal-${actualId}`).classList.add('hidden');
        document.getElementById(`modal-background-${actualId}`).classList.add('hidden');
    });
});

document.querySelectorAll('div[id^="modal-background-"]').forEach(background => {
    background.addEventListener('click', function() {
        const actualId = this.id.split('-').pop();
        document.getElementById(`modal-${actualId}`).classList.add('hidden');
        document.getElementById(`modal-background-${actualId}`).classList.add('hidden');
    });
});

function fetchPdfUrls(month, actualId, buttonId) {
    const filePreviewUrl = "{{ route('report.showFile') }}";
    const url = `${filePreviewUrl}?month=${month}&actual_id=${actualId}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
           
            const index = buttonId.split('-').pop();
            pdfData[index] = data; // Store pdfUrls for this modal
            currentIndexes[index] = 0; // Initialize currentIndex for this modal
            updatePdfViewer(buttonId, actualId);
            const modalId = `modal-${actualId}`;
            const backgroundId = `modal-background-${actualId}`;
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(backgroundId).classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching PDF URLs:', error));
}

function updatePdfViewer(buttonId, actualId) {
    const index = buttonId.split('-').pop();
    const pdfObject = document.getElementById(`pdfObject-${index}`);
    const prevButton = document.getElementById(`prevButton-${index}`);
    const nextButton = document.getElementById(`nextButton-${index}`);
    const fileNumberElement = document.getElementById(`fileNumber-modal-${index}`);
    const currentIndex = currentIndexes[index]; // Get currentIndex for this modal
    const pdfUrls = pdfData[index]; // Get pdfUrls for this modal

    if (pdfUrls.length > 0) {
        const currentPdf = pdfUrls[currentIndex];
        const baseUrl = "{{ asset('record_files') }}";
        pdfObject.data = `${baseUrl}/${currentPdf.record_file}`;
        console.log(pdfObject.data);
        
        fileNumberElement.textContent = `${currentPdf.kpi_code} | ${currentPdf.kpi_item}`;
    } else {
        pdfObject.data = '';
        fileNumberElement.textContent = '';
    }

    // Remove existing event listeners
    prevButton.replaceWith(prevButton.cloneNode(true));
    nextButton.replaceWith(nextButton.cloneNode(true));

    // Reassign the buttons after cloning
    const newPrevButton = document.getElementById(`prevButton-${index}`);
    const newNextButton = document.getElementById(`nextButton-${index}`);

    newPrevButton.addEventListener('click', function() {
        const modalElement = document.getElementById(`modal-${actualId}`);
        const month = modalElement.dataset.month;
        const modalIds = modalOrder[month];
        if (modalIds) {
            const currentModalIndex = modalIds.indexOf(actualId);
            if (currentModalIndex > 0) {
                const prevModalId = modalIds[currentModalIndex - 1];
                const prevActualId = prevModalId.split('-').pop();
                document.getElementById(`modal-${actualId}`).classList.add('hidden');
                document.getElementById(`modal-background-${actualId}`).classList.add('hidden');
                fetchPdfUrls(month, prevActualId, `prevButton-${prevActualId}`);
            }
        }
    });

    newNextButton.addEventListener('click', function() {
        const modalElement = document.getElementById(`modal-${actualId}`);
        const month = modalElement.dataset.month;
        const modalIds = modalOrder[month];
        if (modalIds) {
            const currentModalIndex = modalIds.indexOf(actualId);
            if (currentModalIndex < modalIds.length - 1) {
                const nextModalId = modalIds[currentModalIndex + 1];
                const nextActualId = nextModalId.split('-').pop();
                document.getElementById(`modal-${actualId}`).classList.add('hidden');
                document.getElementById(`modal-background-${actualId}`).classList.add('hidden');
                fetchPdfUrls(month, nextActualId, `nextButton-${nextActualId}`);
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-checkbox').forEach(function(checkbox) {
        if (checkbox.checked) {
            checkbox.disabled = true;
        }
        checkbox.addEventListener('change', function() {
            const actualId = this.getAttribute('data-actual-id');
            const status = this.getAttribute('data-status');
            const isChecked = this.checked;
            const url = "{{ route('actual.updateActual') }}"

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    actual_id: actualId,
                    status: status,
                    checked: isChecked
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    });
});

let exportButton = document.getElementById("exportBtn");
    exportButton.addEventListener("click", e => {
        // Create a copy of the table
        let originalTable = document.querySelector("#exportTable");
        let tableCopy = originalTable.cloneNode(true);

        // Remove modal elements from the copy
        tableCopy.querySelectorAll('.exclude-from-export').forEach(element => {
            element.remove();
        });

        tableCopy.querySelectorAll('td').forEach(cell => {
            if (cell.textContent.trim() === 'No') {
                cell.setAttribute('data-f-color', 'FFFF0000'); // Red
            } else if (cell.textContent.trim() === 'Yes') {
                cell.setAttribute('data-f-color', 'FF00CC00'); // Green
            } else if (cell.textContent.trim() === 'Review') {
                cell.setAttribute('data-f-color', 'FF3399FF'); // Blue
            } else if (cell.textContent.trim() === 'Check') {
                cell.setAttribute('data-f-color', 'FFFF9900'); // Orange
            }
        });

        // Export the copied table
        TableToExcel.convert(tableCopy, {
            name: "employee_report.xlsx",
            sheet: {
                name: "Sheet 1"
            }
        });
    });

</script>
</x-app-layout>