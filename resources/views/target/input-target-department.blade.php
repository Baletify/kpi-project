<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <button class="p-2 bg-blue-600 my-2 rounded-md">
            <a href="/target/input-target-kpi-department?department={{ $departments->first()->department_id }}">
                <span class="text-white">Input Target Dept</span>
              </a>
        </button>
        <table class="w-full">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-2 px-4 bg-blue-700">No.</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-2 px-4 bg-blue-700">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-2 px-4 bg-blue-700">Nama</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-2 px-4 bg-blue-700">Department</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-2 px-4 bg-blue-700">Jabatan</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-2 px-4 bg-blue-700">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($departments as $department)
            <tr>
                @php
                    $i++
                @endphp
                <td class="border-2 border-gray-400 tracking-wide px-2 py-2 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 tracking-wide px-2 py-2">{{ $department->nik }}</td>
                <td class="border-2 border-gray-400 tracking-wide px-2 py-2">{{ $department->employee }}</td>
                <td class="border-2 border-gray-400 tracking-wide px-2 py-2">{{ $department->department }}</td>
                <td class="border-2 border-gray-400 tracking-wide px-2 py-2">{{ $department->occupation }}</td>
                <td class="border-2 border-gray-400 tracking-wide px-2 py-2">
                    <div class="flex justify-center gap-2">
                    <a href="/target/input-target-kpi?employee={{ $department->employee_id }}">
                      <span class="text-blue-500">Input KPI Individu</span>
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