<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        @php
        $i = 0;
        $currentMonth = \Carbon\Carbon::now()->month;
        $currentYear = \Carbon\Carbon::now()->year;
        $yearToShow = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
        @endphp
        <div class="flex">
            <div class="relative mt-1 rounded-md mb-1">
                <button class="p-2 bg-blue-600 my-2 rounded-md">

                    <a href="/actual/input-actual-department-details?department={{ $departments->first()->department_id }}&year={{ $yearToShow }}">
                        <span class="text-white">Input Aktual Dept</span>
                      </a>
                </button>
            </div>
           
            <div class="relative mt-1 rounded-md">
                <div class="mt-2 mb-1 mx-2">
                    <select name="year" id="year" class=" w-28 h-10">
                        <option value="">-- Tahun --</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                    </select>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center">
                </div>
              </div>
        </div>

        <table class="w-full">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">No.</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Nama</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Department</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Jabatan</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Aksi</th>
            </tr>

            @forelse ($departments as $department)
            @php
            $i++
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-gray-200' : 'bg-gray-300' }}">
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->nik }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->employee }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->department }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->occupation }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">
                    <div class="flex justify-center gap-2 text-[12px]">
                        <a id="employee-link-{{ $department->employee_id }}" href="/actual/input-actual-employee?employee={{ $department->employee_id }}">
                            <span class="hover:underline text-blue-600">Input Aktual Individu</span>
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
<script>
    document.getElementById('year').addEventListener('change', function() {
        const year = this.value;
        const links = document.querySelectorAll('a[id^="employee-link-"]');
        links.forEach(link => {
            const url = new URL(link.href);
            url.searchParams.set('year', year);
            link.href = url.toString();
        });
    });
</script>