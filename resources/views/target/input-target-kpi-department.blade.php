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
                $currentSemester = request()->query('semester');
                $months = [];
            
                if ($currentSemester == 1) {
                    $months = [
                        '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', 
                        '5' => 'May', '6' => 'Jun'
                    ];
                } else {
                    $months = [
                        '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', 
                        '11' => 'Nov', '12' => 'Dec'
                    ];
                }
            @endphp
            
            @foreach ($months as $month)

                <th style="width: 5%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">{{ $month }}</th>
                
            @endforeach
                {{-- <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Aksi</th> --}}
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

                @if ($currentSemester == 1)
                @foreach (range(1, 6) as $month)
                    <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                        {{ $isPercentage && $target->{'target_' . $month} !== null ? $target->{'target_' . $month} * 100 . '%' : ($isRp ? ($target->{'target_' . $month} !== null ? number_format($target->{'target_' . $month}) : '') : ($target->{'target_' . $month} !== null ? $target->{'target_' . $month} : '')) }}
                    </td>
                @endforeach
                @else
                @foreach (range(7, 12) as $month)
                    <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                        {{ $isPercentage && $target->{'target_' . $month} !== null ? $target->{'target_' . $month} * 100 . '%' : ($isRp ? ($target->{'target_' . $month} !== null ? number_format($target->{'target_' . $month}) : '') : ($target->{'target_' . $month} !== null ? $target->{'target_' . $month} : '')) }}
                    </td>
                @endforeach
                @endif
                </tr>
            @empty
            <tr>
                <td colspan="16" class="border-2 border-gray-400 tracking-wide  py-0 px-2 text-center">Data Tidak ditemukan</td>
            </tr>
            @endforelse
        </table>
    </div>
</x-app-layout>