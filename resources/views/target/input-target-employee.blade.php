<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <table class="w-full">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-700 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">No.</th>
                <th class="border-2 border-gray-700 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">NIK</th>
                <th class="border-2 border-gray-700 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Nama</th>
                <th class="border-2 border-gray-700 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Department</th>
                <th class="border-2 border-gray-700 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Jabatan</th>
                <th class="border-2 border-gray-700 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($employees as $employee)
            <tr>
                @php
                    $i++
                @endphp
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $employee->nik }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $employee->name }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $employee->department }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $employee->occupation }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">
                    <div class="flex justify-center gap-2">
                    <a href="/target/input-target-kpi/{{ $employee->id }}">
                      <span class="text-blue-500">Pengisian Data Target KPI</span>
                    </a>
                </div>
                </td>
            </tr>
            @empty
            <div class="">
                <span>Data Belum Tersedia</span>
            </div>
            @endforelse
        </table>
    </div>
</x-app-layout>