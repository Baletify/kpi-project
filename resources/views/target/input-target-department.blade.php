<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">

        <div class="flex justify-end">

            <div class="relative mt-1 rounded-md">
                <div class="mt-2 mb-1 mx-2">
                    <select name="year" id="year" class=" w-28 h-10 text-[12px]">
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
              <div class="relative mt-1 rounded-md mb-1">
                <button class="p-2 bg-blue-600 my-2 rounded-md">
                    <a id="input-target-link" href="/target/input-target-kpi-department?department={{ $departments->first()->department_id }}&year=">
                        <span class="text-white">Input Target Dept</span>
                      </a>
                </button>
            </div>
        </div>
        
        <table class="w-full table-auto">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">No.</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Nama</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Department</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Jabatan</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Input Target Individu</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Upload Program</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($departments as $department)
            @php
            $i++
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}">

                <td style="width: 3%" class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->nik }}</td>
                <td style="width: 28%" class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->employee }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->department }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">{{ $department->occupation }}</td>
                <td class="border-2 border-gray-400 tracking-wide text-[12px] px-2 py-0">
                    <div class="flex justify-center gap-2">
                    <a id="employee-link-{{ $department->employee_id }}" href="/target/input-target-kpi?employee={{ $department->employee_id }}">
                      <span class="text-blue-500 hover:underline">Input Target Individu</span>
                    </a>
                </div>
                </td>
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2 text-center">
                    @if(!$department->file)
                    <a href="{{ url('action-plan/input-action-plan/' . $department->employee_id ) }}">
                        <i class="ri-add-line bg-green-600 text-white text-sm p-0.5 rounded-sm"></i>
                       </a>
                     @endif
                    @if ($department->file)
                   <a href="{{ route('action-plan.showFile', $department->file) }}" target="_blank">
                    <i class="ri-eye-fill text-sm p-0.5 bg-blue-600 text-white rounded-sm"></i>
                   </a>
                   <a href="{{ url('action-plan/input-action-plan/edit/' . $department->action_plan_id) }}">
                    <i class="ri-edit-box-line p-0.5 text-sm bg-yellow-400 text-white rounded-sm"></i>
                   </a>
                   @endif
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

<script>
    document.getElementById('year').addEventListener('change', function() {
        const year = this.value;
        const links = document.querySelectorAll('a[id^="employee-link-"]');
        links.forEach(link => {
            const url = new URL(link.href);
            url.searchParams.set('year', year);
            link.href = url.toString();
        });

        const inputTargetLink = document.getElementById('input-target-link');
        const url = new URL(inputTargetLink.href);
        url.searchParams.set('year', year);
        inputTargetLink.href = url.toString();
    });
</script>