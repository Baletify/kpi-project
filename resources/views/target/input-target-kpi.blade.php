<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
        <div class="p-2 mb-2 mt-2">
            <a href="#" class="p-4 bg-blue-500 py-2 items-center">
                <i class="ri-import-line text-2xl text-white"></i>
                <span class="font-medium text-white">Import</span>
            </a>
        </div>
        <table class="w-full table-auto">
            <tr>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200" style="width: 3%">No.</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">NIK</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Kode KPI</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200" style="width: 35%">KPI</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Cara Menghitung</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Data Pendukung</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Periode Review</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Unit</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Bobot "%"</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Jan</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Feb</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Mar</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Apr</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">May</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Jun</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Aksi</th>
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
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $employee->nik }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->code }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->indicator }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->calculation }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    {{ $target->supporting_document }}
                </td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->period }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0">{{ $target->unit }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->weighting }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_1 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_2}}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_3 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_4 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_5 }}</td>
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">{{ $target->target_6 }}</td>
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