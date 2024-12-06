<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
        @php
            $yearQuery = request()->query('year');
        @endphp
        <div class="p-0">
            <span class="font-bold text-2xl">Target KPI Departemen {{ $departments->name }} Tahun {{ $yearQuery }}</span>
        </div>
        <div class="flex justify-end">
            <div class="mb-3 mt-2">
                <a href="/target/import-target-kpi-department?department={{ request()->query('department') }}&year={{ request()->query('year') }}" class="p-1 mx-2 bg-blue-500 py-2 items-center rounded-md">
                    <i class="ri-import-line text-2xl text-white"></i>
                    <span class="font-medium text-white">Import</span>
                </a>
            </div>
        </div>
        <table class="w-full table-auto">
            <tr>
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Kode KPI</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700" style="width: 13%">KPI</th>
                <th style="width: 18%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Cara Menghitung</th>
                <th style="width: 18%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Data Pendukung</th>
                <th style="width: 3%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Trend</th>
                <th style="width: 3%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Periode Review</th>
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Unit</th>
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Bobot "%"</th>
                @php
            $currentMonth = \Carbon\Carbon::now()->month;
            $months = [];
        
            if ($currentMonth >= 2 && $currentMonth < 7) {
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
            
            @foreach ($months as $month)

                <th style="width: 5%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">{{ $month }}</th>
                
            @endforeach
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($targets as $target)
            @php
            $i++
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}">

                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->code }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->indicator }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->calculation }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">
                    {{ $target->supporting_document}}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">
                    {{ $target->trend}}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->period }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->unit }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->weighting }}</td>

                @php
                $isPercentage = $target->unit === '%';
                $isRp = $target->unit === 'Rp';
                
                @endphp

                @if ($currentMonth >= 2 && $currentMonth <= 7)
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_1 !== null ? $target->target_1 * 100 . '%' : ($isRp ? ($target->target_1 !== null ? number_format($target->target_1) : '') : ($target->target_1 !== null ? $target->target_1 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_2 !== null ? $target->target_2 * 100 . '%' : ($isRp ? ($target->target_2 !== null ? number_format($target->target_2) : '') : ($target->target_2 !== null ? $target->target_2 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_3 !== null ? $target->target_3 * 100 . '%' : ($isRp ? ($target->target_3 !== null ? number_format($target->target_3) : '') : ($target->target_3 !== null ? $target->target_3 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_4 !== null ? $target->target_4 * 100 . '%' : ($isRp ? ($target->target_4 !== null ? number_format($target->target_4) : '') : ($target->target_4 !== null ? $target->target_4 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_5 !== null ? $target->target_5 * 100 . '%' : ($isRp ? ($target->target_5 !== null ? number_format($target->target_5) : '') : ($target->target_5 !== null ? $target->target_5 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_6 !== null ? $target->target_6 * 100 . '%' : ($isRp ? ($target->target_6 !== null ? number_format($target->target_6) : '') : ($target->target_6 !== null ? $target->target_6 : '')) }}
                </td>
                @else
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_7 !== null ? $target->target_7 * 100 . '%' : ($isRp ? ($target->target_7 !== null ? number_format($target->target_7) : '') : ($target->target_7 !== null ? $target->target_7 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_8 !== null ? $target->target_8 * 100 . '%' : ($isRp ? ($target->target_8 !== null ? number_format($target->target_8) : '') : ($target->target_8 !== null ? $target->target_8 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_9 !== null ? $target->target_9 * 100 . '%' : ($isRp ? ($target->target_9 !== null ? number_format($target->target_9) : '') : ($target->target_9 !== null ? $target->target_9 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_10 !== null ? $target->target_10 * 100 . '%' : ($isRp ? ($target->target_10 !== null ? number_format($target->target_10) : '') : ($target->target_10 !== null ? $target->target_10 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_11 !== null ? $target->target_11 * 100 . '%' : ($isRp ? ($target->target_11 !== null ? number_format($target->target_11) : '') : ($target->target_11 !== null ? $target->target_11 : '')) }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $isPercentage && $target->target_12 !== null ? $target->target_12 * 100 . '%' : ($isRp ? ($target->target_12 !== null ? number_format($target->target_12) : '') : ($target->target_12 !== null ? $target->target_12 : '')) }}
                </td>
                @endif
               
                
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    <a href="/target/input-target-kpi-department/edit/{{ $target->department_target_id }}">
                        <i class="ri-edit-box-line p-0.5 text-xl bg-yellow-400 text-white rounded-sm"></i>
                    </a>
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