<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <button class="p-2 bg-blue-600 my-2 rounded-md">
            <a href="/actual/input-actual-department-details?department={{ $departments->first()->department_id }}">
                <span class="text-white">Input Aktual Dept</span>
              </a>
        </button>
        <table class="w-full">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-700 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">No.</th>
                <th class="border-2 border-gray-700 text-[10px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">NIK</th>
                <th class="border-2 border-gray-700 text-[10px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Nama</th>
                <th class="border-2 border-gray-700 text-[10px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Department</th>
                <th class="border-2 border-gray-700 text-[10px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Jabatan</th>
                <th class="border-2 border-gray-700 text-[10px] uppercase tracking-wide font-medium text-gray-600 py-2 px-4 bg-yellow-200">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($departments as $department)
            <tr>
                @php
                    $i++
                @endphp
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $department->nik }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $department->employee }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $department->department }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">{{ $department->occupation }}</td>
                <td class="border-2 border-gray-700 tracking-wide px-2 py-2">
                    <div class="flex justify-center gap-2">
                    <a href="/actual/input-actual-employee?employee={{ $department->employee_id }}">
                        <span class="text-blue-500">Input Aktual Individu</span>
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