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
                <span class="text-gray-600 font-bold text-xs text-center">Periode: {{ $actuals->first()->semester }} {{ $actuals->first()->year }}</span>
            </div>
            <div class="">
                <span class="text-gray-600 font-bold text-xs text-center">Divisi: {{ $actuals->first()->department }}</span>
            </div>
        </div>

        <div class="p-1 mt-5">
            <table class="w-full table-auto">
                <thead>
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
                        <th style="width: 3%;" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2">No. KPI</th>
                        <th style="width: 30%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >KPI</th>
                        <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >Periode Review</th>
                        <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >Trend</th>
                        <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >Unit</th>
                        <th style="width: 3%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >Bobot "%"</th>
                        <th style="width: 5%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2"></th>
                        <th style="width: 50%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" colspan="7">Target & Actual KPI</th>
                        <th style="5%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2">Bobot Pencapaian</th>
                    </tr>
                    <tr>
                        @foreach ($months as $month)
                            
                        <th style="width: 7%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >{{ $month }}</th>
                        @endforeach
                        <th style="width: 7%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >Total</th>
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
                    <tr class="{{ $i % 2 === 0 ? 'bg-blue-100' : 'bg-gray-50' }}">
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $target->code }}</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="5">{{ $target->indicator }}</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center" rowspan="5">{{ $target->period }}</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-center text-gray-600 py-0 px-2" rowspan="5">{{ $target->trend }}</td>
                        <td class="border-2 text-center border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="5">{{ $target->unit }}</td>
                        <td class="border-2 text-center border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="5">{{ $target->weighting }}</td>
                    </tr>
                    
                    <tr class="bg-blue-100">
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center">Target</td>
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
                        @if (strpos($totalTarget, '%') !== false)
                            {{ number_format($totalTarget) }}
                        @else
                            {{ number_format($totalTarget) }}%
                        @endif
                     </td>
                 @else
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                    @php
                        $totalWeightingAchievement = $totals[$target->code] ['total_achievement_weight'] ?? 0 ;
                    @endphp
                     @if ($totalWeightingAchievement > 0)
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4">{{ number_format($totalWeightingAchievement) }}%</td>
                    @else
                     <td class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4"></td>
                    @endif
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center">Actual</td>
                        @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $actual ? $actual->actual : '' }}</td>
                    @endforeach

                    @php
                         $totalActual = $totals[$target->code]['total_actual'] ?? 0;
                    @endphp
                    @if ($totalTarget > 0)
                     <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                        @if (strpos($totalActual, '%') !== false)
                        {{ number_format($totalActual) }}
                        @else
                        {{ number_format($totalActual) }}%
                        @endif
                     </td>
                 @else
                     <td class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                    </tr>
                    <tr class="bg-blue-100">
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center">%</td>
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
                    <tr class="bg-gray-50">
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center">Rekaman</td>
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
                            $modalId = 'modal-' . $actual->department_actual_id;
                            $buttonId = 'open-modal-' . $actual->department_actual_id;
                            $backgroundId = 'modal-background-' . $actual->department_actual_id;
                            $date = \Carbon\Carbon::parse($actual->date); // Parse the date
                            $prevButtonId = 'prevButton-' . $actual->department_actual_id;
                            $nextButtonId = 'nextButton-' . $actual->department_actual_id;
                            $pdfObjectId = 'pdfObject-' . $actual->department_actual_id;
                        @endphp
                            <button id="{{ $buttonId }}" class="hover:underline" data-month="{{ $date->format('m') }}">
                                @if ($actual->status == 'Approved')
                                <span class="text-green-500">Yes</span>
                                @elseif ($actual->status == 'Checked')
                                <span class="text-blue-500">Review</span>
                                @elseif ($actual->status == 'Filled')
                                <span class="text-yellow-500">Check</span>
                                @endif
                            </button>
                            <div id="{{ $backgroundId }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden"></div>
                            <div id="{{ $modalId }}" class="fixed inset-0 items-center justify-center hidden">
                                <div class="flex justify-center mt-3">
                                    <div class="bg-gray-50 rounded-lg shadow-lg p-3 w-1/2 max-h-screen overflow-y-hidden">
                                    <div class="">
                                        <h2 class="text-xl font-bold mb-0.5">Review Data Pendukung</h2>
                                    </div>
                                    <div class="p-1 flex justify-between">
                                        <button id="{{ $prevButtonId }}" class="bg-blue-500 text-white p-2 text-[12px] rounded">Previous</button>
                                        <button id="{{ $nextButtonId }}" class="bg-blue-500 text-white p-2 text-[12px] rounded">Next</button>
                                    </div>
                                    <div id="pdfViewer" class="mt-1">
                                        <object id="{{ $pdfObjectId }}" type="application/pdf" width="100%" height="400px"></object>
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
                                            <form action="{{ route('actual.updateActualDept') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @php
                                                    $now = Carbon\Carbon::now();
                                                @endphp
                                                @if ($actual->status == 'Checked')
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded text-[12px]">
                                                    <input type="hidden" name="status" id="status" value="Approved">
                                                    <input type="hidden" name="approved_by" id="approved_by" value="HR">
                                                    <input type="hidden" name="approved_at" value="{{ $now }}">
                                                    <span>Approve</span>
                                                </button>
                                                @elseif ($actual->status == 'Filled')
                                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded text-[12px]">
                                                    <input type="hidden" name="status" id="status" value="Checked">
                                                    <span>Check</span>
                                                    <input type="hidden" name="checked_by" id="checked_by" value="Admin Office">
                                                    <input type="hidden" name="checked_at" value="{{ $now }}">
                                                </button>
                                                @endif
                                            <input type="hidden" name="department_actual_id" id="department_actual_id" value="{{ $actual->department_actual_id }}">
                                            </form>
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
                    </td>
                    @endforeach
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>


<script src="https://unpkg.com/pdfobject"></script>


    
    <script>
        let currentIndex = 0;
        let pdfUrls = [];
    
        document.querySelectorAll('button[id^="open-modal-"]').forEach(button => {
            button.addEventListener('click', function() {
                const month = this.dataset.month;
                
                fetchPdfUrls(month, this.id);
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
    
        function fetchPdfUrls(month, buttonId) {
            
            fetch(`/report/file-preview-dept?month=${month}`)
                .then(response => response.json())
                .then(data => {
                    
                    pdfUrls = data;
                    currentIndex = 0;
                    updatePdfViewer(buttonId);
                    const modalId = buttonId.replace('open-modal-', 'modal-');
                    const backgroundId = buttonId.replace('open-modal-', 'modal-background-');
                    document.getElementById(modalId).classList.remove('hidden');
                    document.getElementById(backgroundId).classList.remove('hidden');
                    
                })
                .catch(error => console.error('Error fetching PDF URLs:', error));
        }
    
        function updatePdfViewer(buttonId) {
            const index = buttonId.split('-').pop();
            const pdfObject = document.getElementById(`pdfObject-${index}`);
            const prevButton = document.getElementById(`prevButton-${index}`);
            const nextButton = document.getElementById(`nextButton-${index}`);
    
            if (pdfUrls.length > 0) {
                
                pdfObject.data = `/record_files/${pdfUrls[currentIndex]}`;
            } else {
                pdfObject.data = '';
            }
    
            prevButton.addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updatePdfViewer(buttonId);
                }
            });
    
            nextButton.addEventListener('click', function() {
                if (currentIndex < pdfUrls.length - 1) {
                    currentIndex++;
                    updatePdfViewer(buttonId);
                }
            });
        }
    </script>