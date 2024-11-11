<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <button class="p-2 bg-blue-600 my-2 rounded-md">
            <a href="/target/input-target-kpi-department?department={{ $departments->first()->department_id }}">
                <span class="text-white">Input Target Dept</span>
              </a>
        </button>
        <table class="w-full">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">No.</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Nama</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Department</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Jabatan</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($departments as $department)
            @php
            $i++
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-gray-100' : 'bg-gray-200' }}">

                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->nik }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->employee }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->department }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->occupation }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">
                    <div class="flex justify-center gap-2">
                    <a href="/target/input-target-kpi?employee={{ $department->employee_id }}">
                      <span class="text-blue-500 hover:underline">Input KPI Individu</span>
                    </a>
                </div>
                </td>
            </tr>
            @empty
            <<tr>
                <td colspan="16" class="border-2 border-gray-400 tracking-wide  py-0 px-2 text-center">Data Tidak ditemukan</td>
            </tr>
            @endforelse
        </table>
    </div>
</x-app-layout>