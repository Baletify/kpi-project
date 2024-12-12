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
                <span id="departmentName" class="text-gray-600 font-bold text-xs text-center">Divisi: {{ $actuals->first()->department }}</span>
            </div>
        </div>
        <div class="flex justify-end mr-1">
            <button id="exportBtn" class="p-1.5 rounded-md text-white bg-green-500">Export</button>
        </div>

        <div class="p-1 mt-1">
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
                    <tr> @foreach ($months as $month)
                        <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 7%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" >{{ $month }}</th>
                        @endforeach
                        <th data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="#ff0066ff" data-f-color="#ffffffff" style="width: 7%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 px-0.5 bg-blue-700" >Total</th>
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
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="4">{{ $target->code }}</td>
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="4">{{ $target->indicator }}</td>
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center" rowspan="4">{{ $target->period }}</td>
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-center text-gray-600 py-0 px-2" rowspan="4">{{ $target->trend }}</td>
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 text-center border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="4">{{ $target->unit }}</td>
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 text-center border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2" rowspan="4">{{ $target->weighting }}</td>
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center bg-blue-100">Target</td>
                        @foreach ($months as $month => $monthName)
                @php
                    $actual = $actuals->first(function($item) use ($target, $month) {
                        return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                    });
                @endphp
                <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $actual ? $actual->target : '' }}</td>
            @endforeach
                    
                    @php
                        $totalTarget = $totals[$target->code]['total_target'] ?? 0;
                    @endphp
                @if ($totalTarget > 0)
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                        @if (strpos($totalTarget, '%') !== false)
                            {{ number_format($totalTarget) }}
                        @else
                            {{ number_format($totalTarget) }}%
                        @endif
                     </td>
                 @else
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                    @php
                        $totalWeightingAchievement = $totals[$target->code] ['total_achievement_weight'] ?? 0 ;
                    @endphp
                     @if ($totalWeightingAchievement > 0)
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4">{{ number_format($totalWeightingAchievement) }}%</td>
                    @else
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center" rowspan="4"></td>
                    @endif
                    </tr>
                    <tr class="bg-gray-50">
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center">Actual</td>
                        @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">{{ $actual ? $actual->actual : '' }}</td>
                    @endforeach

                    @php
                         $totalActual = $totals[$target->code]['total_actual'] ?? 0;
                    @endphp
                    @if ($totalTarget > 0)
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center">
                        @if (strpos($totalActual, '%') !== false)
                        {{ number_format($totalActual) }}
                        @else
                        {{ number_format($totalActual) }}%
                        @endif
                     </td>
                 @else
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                    </tr>
                    <tr class="bg-blue-100">
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center">%</td>
                        @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
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
                     <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-blue-100 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                 @endif
                    </tr>
                    <tr class="bg-gray-50">
                        <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-2 text-center">Rekaman</td>
                        @foreach ($months as $month => $monthName)
                    @php
                        $actual = $actuals->first(function($item) use ($target, $month) {
                            return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->kpi_item == $target->indicator;
                        });
                    @endphp
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 bg-gray-50 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center hover:underline">
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
                            <button id="{{ $buttonId }}" class="hover:underline" data-month="{{ $date->format('m') }}" data-actual-id="{{ $actual->department_actual_id }}">
                                @if ($actual->status == 'Approved')
                                <span class="text-green-500">Yes</span>
                                @elseif ($actual->status == 'Checked')
                                <span class="text-blue-500">Review</span>
                                @elseif ($actual->status == 'Filled')
                                <span class="text-yellow-500">Check</span>
                                @endif
                            </button>
                            <div id="{{ $backgroundId }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden exclude-from-export"></div>
                            <div id="{{ $modalId }}" class="modal fixed inset-0 justify-center hidden exclude-from-export" data-month="{{ $date->format('m') }}">
                                <div class="flex justify-center mt-3">
                                    <div class="bg-gray-50 rounded-lg shadow-lg p-3 w-1/2 max-h-screen overflow-y-hidden">
                                    <div class="flex flex-col">
                                        <h2 class="text-xl font-bold mb-0.5">Review Data Pendukung</h2>
                                        <span class="text-[12px] tracking-wide font-medium text-gray-600 mb-0.5">Bulan: {{ $monthName }}</span>
                                        <div class="">
                                            <span id="fileNumber-modal-{{ $actual->department_actual_id }}" class="text-[12px] tracking-wide font-medium text-gray-600 mb-1"></span>
                                        </div>
                                    </div>
                                    <div class="p-1 flex justify-between">
                                        <button id="{{ $prevButtonId }}" class="bg-blue-500 text-white p-2 text-[12px] rounded">Previous</button>
                                        <button id="{{ $nextButtonId }}" class="bg-blue-500 text-white p-2 text-[12px] rounded">Next</button>
                                    </div>
                                    <div id="pdfViewer" class="mt-1">
                                        <object id="{{ $pdfObjectId }}" type="application/pdf" width="100%" height="400px"></object>
                                    </div>
                                    <div id="checkbox-container-{{ $modalId }}" class="p-1 flex justify-center gap-3">
                                        <label class="text-[14px]">
                                            <input type="checkbox" class="status-checkbox" data-actual-id="{{ $actual->department_actual_id }}" data-status="Checked" {{ $actual->status == 'Checked' || 'Approved' ? 'checked' : '' }}>
                                            Check
                                        </label>
                                        <label class="text-[14px]">
                                            <input type="checkbox" class="status-checkbox" data-actual-id="{{ $actual->department_actual_id }}" data-status="Approved" {{ $actual->status == 'Approved' ? 'checked' : '' }}>
                                            Approve
                                        </label>
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
                    </td>
                    @endforeach
                    <td data-b-a-s="thin" data-a-h="center" data-a-v="middle" data-a-wrap="true" data-fill-color="{{ $i % 2 === 0 ? '#fff2f2f2' : '#ffffffff' }}" class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-0.5 text-center"></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>


<script src="https://unpkg.com/pdfobject"></script>
<script type="text/javascript" src="{{ asset('js/tableToExcel.js') }}"></script>


    
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

    // fetch pdf url 
    function fetchPdfUrls(month, actualId, buttonId) {
        fetch(`/report/file-preview-dept?month=${month}&actual_id=${actualId}`)
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
    
    // Show PDF
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
            pdfObject.data = `/record_files/${currentPdf.record_file}`;
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

        // Hit request when pressing  next or prev button
        // based on modal order
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

            fetch('/actual/input-actual-achievement/update', {
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
        let departmentName = document.getElementById("departmentName").textContent.replace('Divisi: ', '').trim();

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
            name: `Dept_${departmentName}_Report.xlsx`,
            sheet: {
                name: "Sheet 1"
            }
        });
    });
    </script>