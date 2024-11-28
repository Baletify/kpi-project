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
                    <th style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2">No. KPI</th>
                    <th style="width: 25%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >KPI</th>
                    <th style="width: 3%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Trend</th>
                    <th style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Periode Review</th>
                    <th style="width: 3%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Unit</th>
                    <th style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2" >Bobot "%"</th>
                    <th style="width: 6%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2"></th>
                    <th style="width: 40%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" colspan="7">Target & Actual KPI</th>
                    <th class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" rowspan="2">Bobot Pencapaian</th>
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
                <tr> @foreach ($months as $month)
                    <th style="width: 7%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" >{{ $month }}</th>
                    @endforeach
                    <th style="width: 7%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" >Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($targets as $target)
                @php
                    $i++;
                @endphp
                <tr class="{{ $i % 2 === 0 ? 'bg-gray-50' : 'bg-blue-100' }}">
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="5">{{ $target->code }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-3" rowspan="5">{{ $target->indicator }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-3" rowspan="5">{{ $target->trend }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="5">{{ $target->period }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="5">{{ $target->unit }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="5">
                        {{ $target->weighting }}
                    </td>
                </tr>
                
                <tr>
                    <td class="border-2 bg-blue-100  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">Target</td>
                    @foreach ($months as $month => $monthName)
                @php
                    $actual = $actuals->first(function($item) use ($target, $month) {
                        return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                    });
                @endphp
                <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $actual ? $actual->target : '' }}</td>
            @endforeach
                    
                    @php
                        $totalTarget = $totals[$target->code]['total_target'] ?? 0;
                    @endphp
                @if ($totalTarget > 0)
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                        @if ($target->unit === '%')
                            {{ $totalTarget }}%
                        @else
                            {{ $totalTarget }}
                        @endif
                     </td>
                 @else
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                    @php
                        $totalWeightingAchievement = $totals[$target->code] 
                        ['total_achievement_weight'] ?? 0 ;
                    @endphp
                     @if ($totalWeightingAchievement > 0)
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4">{{ number_format($totalWeightingAchievement, 1) }}%</td>
                    @else
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4"></td>
                    @endif
                </tr>
                <tr>
                    <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">Actual</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                    @if ($actual)
                    @if ($target->unit === '%')
                        {{ $actual->actual }}%
                    @else
                        {{ $actual->actual }}
                    @endif
                @endif
                    </td>
                    @endforeach

                    @php
                         $totalActual = $totals[$target->code]['total_actual'] ?? 0;
                    @endphp
                    @if ($totalTarget > 0)
                     <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                        @if ($target->unit === '%')
                        {{ $totalActual }}%
                        @else
                        {{ $totalActual }}
                        @endif
                     </td>
                 @else
                     <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                </tr>
                <tr>
                    <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">%</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $actual ? $actual->kpi_percentage : '' }}</td>
                    @endforeach
                    @php
                         $totalPercentage = $totals[$target->code]['total_percentage'] ?? 0;

                    @endphp
                    @if ($totalTarget > 0)
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ number_format($totalPercentage) }} %</td>
                 @else
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                </tr>
                <tr>
                    <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">Rekaman</td>
                    @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center hover:underline">
                        @if ($actual)
                            @if ($actual->record_file)
                            @php
                            $modalId = 'modal-' . $actual->actual_id;
                            $buttonId = 'open-modal-' . $actual->actual_id;
                            $backgroundId = 'modal-background-' . $actual->actual_id;
                        @endphp
                            <button id="{{ $buttonId }}" class="{{ $actual->status == 'Approved' ? 'text-green-600' : 'text-blue-500' }} hover:underline">
                                @if ($actual->status == 'Approved')
                                <span>Yes</span>
                                @else
                                Review
                                @endif
                            </button>
                            <div id="{{ $backgroundId }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden"></div>
                            <div id="{{ $modalId }}" class="fixed inset-0 items-center justify-center hidden">
                                <div class="flex justify-center mt-10">
                                <div class="bg-gray-50 rounded-lg shadow-lg p-6 w-1/3">
                                    <div class="">
                                        <h2 class="text-xl font-bold mb-4">Review Data Pendukung</h2>
                                    </div>
                                    <div class="p-1">
                                        <button class="bg-blue-500 text-white p-2 text-[12px] rounded">
                                            <a href="{{ route('report.showFile', $actual->record_file) }}" target="_blank">Lihat Dokumen</a>
                                        </button>
                                    </div>
                                    @if ($actual->status !== 'Approved')
                                    <div class="p-1 flex justify-start">
                                        <span class="text-semibold mb-1 text-[12px]">Berikan Komentar</span>
                                    </div>
                                    <div class="p-0 mb-2 flex justify-center">
                                        <textarea name="comment" id="comment" cols="58" rows="3"></textarea>
                                    </div>
                                    <div class="flex justify-center gap-3">
                                        
                                        <div class="flex flex-col">
                                            <button class="bg-yellow-500 text-white px-4 py-2 rounded text-[12px] mb-3">
                                                <i class="ri-send-plane-line"></i>
                                                <span>Kirim Revisi</span>
                                            </button>
                                            <form action="{{ route('actual.updateActual') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded text-[12px]">
                                                <input type="hidden" name="actual_id" id="actual_id" value="{{ $actual->actual_id }}">
                                                <input type="hidden" name="status" id="status" value="Approved">
                                                <span>Approve</span>
                                            </button>
                                            </form>
                                        </div>
                                        
                                    </div>
                                    @endif
                                    
                                    <div class="flex justify-end">
                                        <button id="close-modal-{{ $modalId }}" class="bg-red-500 text-white px-4 py-2 rounded mr-2 text-[12px]">Close</button>
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
                    </td>
                    @endforeach
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

    
    
    <script>
        document.querySelectorAll('button[id^="open-modal-"]').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.id.split('-').pop();
                document.getElementById(`modal-${index}`).classList.remove('hidden');
                document.getElementById(`modal-background-${index}`).classList.remove('hidden');
            });
        });
    
        document.querySelectorAll('button[id^="close-modal-"]').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.id.split('-').pop();
                document.getElementById(`modal-${index}`).classList.add('hidden');
                document.getElementById(`modal-background-${index}`).classList.add('hidden');
            });
        });
    
        document.querySelectorAll('div[id^="modal-background-"]').forEach(background => {
            background.addEventListener('click', function() {
                const index = this.id.split('-').pop();
                document.getElementById(`modal-${index}`).classList.add('hidden');
                document.getElementById(`modal-background-${index}`).classList.add('hidden');
            });
        });
    </script>
</x-app-layout>