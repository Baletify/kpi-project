<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
        <div class="justify-end">
            <div class="mb-4 mt-2">
                <a href="#" class="p-2 bg-blue-500 py-2 items-center">
                    <i class="ri-import-line text-2xl text-white"></i>
                    <span class="font-medium text-white">Import</span>
                </a>
            </div>
        </div>
            <div class="p-1">
                <table>
                    <tr>
                        <td style="width: 6%" class="text-[14px] tracking-wide font-medium text-white px-1">Dept</td>
                        <td style="width: 2%" class="text-[14px] tracking-wide font-medium text-white px-1">:</td>
                        <td class="text-[14px] tracking-wide font-medium text-white px-1">{{ $departments->name }}</td>
                    </tr>
                </table>
            </div>
        
        <table class="w-full table-auto">
            <tr>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700" style="width: 3%">No.</th>
                <th style="width: 10%" class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">Kode KPI</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700" style="width: 35%">KPI</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">Cara Menghitung</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">Data Pendukung</th>
                <th style="width: 6%" class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">Periode Review</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">Unit</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">Bobot "%"</th>
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
            
            @foreach ($months as $month)

                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">{{ $month }}</th>
                
            @endforeach
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-white py-1 bg-blue-700">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($targets as $target)
            <tr>
                @php
                    $i++
                @endphp
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->code }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->indicator }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->calculation }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $target->supporting_document}}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->period }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->unit }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->weighting }}</td>

                @if ($currentMonth >= 2 && $currentMonth < 8)
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_1 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_2}}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_3 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_4 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_5 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_6 }}</td>

                @else
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_7 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_8}}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_9 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_10 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_11 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_12 }}</td>
                @endif
               
                
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    <a href="">
                        <i class="ri-edit-2-fill bg-yellow-400 text-sm border border-gray-200 shadow-black"></i>
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