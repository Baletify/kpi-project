<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <table class="w-full bg-white">
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
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">No.</th>
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Kode KPI</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">KPI</th>
                @foreach ($months as $monthName)
                    <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">{{ $monthName }}</th>
                @endforeach
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($targets as $target)
                @php
                    $i++;
                @endphp
                <tr class="{{ $i % 2 === 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2 text-center">{{ $i }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2">{{ $target->code }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2">{{ $target->indicator }}</td>
                    @foreach ($months as $month => $monthName)
                        @php
$actual = $actuals->first(function($item) use ($target, $month) {
            $itemMonth = \Carbon\Carbon::parse($item->actual_date)->format('m');
            $itemIndicator = $item->kpi_code;
            $targetIndicator = $target->code;

            // Debugging output
            // dump('Item Month:', $itemMonth, 'Month:', $month, 'Item Indicator:', $itemIndicator, 'Target Indicator:', $targetIndicator);

            return $itemMonth == $month && $itemIndicator == $targetIndicator;
        });

        // Debugging output
        // dump('Actual:', $actual);
                            
                        @endphp
                        @if ($actual)
                            <td style="width: 6%" class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2 text-center"><i class="ri-checkbox-circle-fill text-xl text-green-500"></i></td>
                        @else
                            <td style="width: 6%" class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2"></td>
                        @endif
                    @endforeach
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2 text-center">
                        <div class="flex justify-center gap-2">
                            @php
                                $year = request()->query('year');
                            @endphp
                            <a href="{{ url('/actual/input-actual-achievement/edit/' . $target->id . '?year=' . $year) }}">
                                <i class="ri-edit-box-line p-0.5 text-xl bg-yellow-400 text-white rounded-sm"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="border-2 border-gray-400 tracking-wide  py-0 px-2 text-center">Data Tidak ditemukan</td>
                </tr>
            @endforelse
        </table>
    </div>
</x-app-layout>