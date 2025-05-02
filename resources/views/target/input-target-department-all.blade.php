<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        @php
        $i = 0;
        $currentYear = Carbon\Carbon::now()->year;
        $startYear = 2024; 
        $endYear = $currentYear + 2;
        $role = auth()->user()->role;
        @endphp
        <div class="flex justify-between">
        <div class="p-0">
            <span class="font-bold text-2xl">Input Target Dept & Upload Program</span>
        </div>
        <div class="flex justify-end items-center mb-2">
            <div class="relative mt-1 rounded-md">
                <div class="mt-2 mb-1 mx-2">
                    <select name="year" id="year" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="">-- Tahun --</option>
                        @for ($year = $startYear; $year <= $endYear; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center">
                </div>
              </div>
              <div class="relative mt-1 rounded-md">
                <div class="mt-2 mb-1 mx-2">
                    <select name="semester" id="semester" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="">-- Semester --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center">
                </div>
              </div>
        </div>
    </div>
    <div class="flex justify-between">
        <div class="p-0">
            <button type="button" class="bg-blue-500 px-2 py-1 text-white rounded-md" onclick="history.back();">
                Back
            </button>
        </div>
        <div class="flex justify-end">
            <div class="p-0">
                <form action="{{ route('target.showDeptOne') }}" method="GET">
                    <div class="mt-3 mb-1 mx-2">
                        <select name="department" id="department" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">-- Departemen --</option>
                            @if ($role == 'Approver' || $role == 'Mng Approver')
                            <option value="all">All Dept</option>
                            @endif
                            @foreach ($deptList as $item)  
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                </div>
                <div class="mt-0 rounded-md mb-1">
                    <button type="submit" class="p-2 bg-blue-600 my-2 rounded-md text-white">
                        Filter
                    </button>
                </form>
            </div>
        </div>
    </div>

        <div class="flex justify-center">
        <table class="w-[550px]">
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">No.</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Departemen</th>
                <th style="width: 3%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Kode Dept</th>
                <th style="width: 45%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Opsi</th>
                <th style="width: 8%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Upload Program</th>
            </tr>

            @php
            $currentSemester = request()->query('semester');
            $department = request()->query('department');
            $year = request()->query('year');
            $allStatus = request()->query('all');
            @endphp

            @forelse ($deptList as $department)
            @php
            $i++
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}">
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->name }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->code }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">
                    <div class="flex justify-center gap-2 text-[12px]">
                        <div class="flex justify-center gap-3 my-0.5">
                            <button class="bg-blue-500 px-2 py-0 rounded-sm my-1">
                                <a id="input-target-link-{{ $department->id }}" href="{{ route('target.showDept', 'department=' . $department->id ?? '' ) }}&semester=&year=&all={{ $allStatus }}" >
                                    <span class="text-white">Lihat Target</span>
                                  </a>
                            </button>
                            @php
                            $now = Carbon\Carbon::now();
                            @endphp
                            @if (($now > $deadline->start_date && $now < $deadline->end_date) || $role == 'Approver')
                            <button class="bg-green-600 px-1.5 py-0 rounded-sm my-1">
                                <a id="input-target-link-{{ $department->id }}" href="{{ route('target.showImportDept') }}?department={{ $department->id ?? '' }}&year={{ $year }}&semester={{ $currentSemester }}&all={{ $allStatus }}">
                                  <span class="text-white hover:underline">Upload Excel</span>
                                </a>
                            </button>
                            @endif
                    </div>
                </div>
                </td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">
                    @if(!$department->file)
                    <a id="input-target-link-{{ $department->id }}" href="{{ route('dept-action-plan.addDeptFile', $department->id) }}?year={{ $year }}&semester={{ $currentSemester }}">
                        <i class="ri-add-line bg-green-600 text-white text-sm p-0.5 rounded-sm"></i>
                       </a>
                     @endif
                    @if ($department->file)
                   <a id="input-target-link-{{ $department->id }}" href="{{ route('action-plan.showFile', $department->file) }}" target="_blank">
                    <i class="ri-eye-fill text-sm p-0.5 bg-blue-600 text-white rounded-sm"></i>
                   </a>
                   <a id="input-target-link-{{ $department->id }}" href="{{ route('dept-action-plan.editDeptFile', $department->id) }}?year={{ $year }}&semester={{ $currentSemester }}">
                    <i class="ri-edit-box-line p-0.5 text-sm bg-yellow-400 text-white rounded-sm"></i>
                   </a>
                   @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="16" class="border-2 border-gray-400 tracking-wide  py-0 px-2 text-center">Data Tidak ditemukan</td>
            </tr>
            @endforelse
        </table>
    </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearDropdown = document.getElementById('year');
        const semesterDropdown = document.getElementById('semester');

        // Set the dropdown values from localStorage if they exist
        const savedYear = localStorage.getItem('selectedYear');
        const savedSemester = localStorage.getItem('selectedSemester');
        if (savedYear) {
            yearDropdown.value = savedYear;
        }
        if (savedSemester) {
            semesterDropdown.value = savedSemester;
        }

        // Function to update links
        function updateLinks() {
            const year = yearDropdown.value;
            const semester = semesterDropdown.value;

            // Update employee links
            const employeeLinks = document.querySelectorAll('a[id^="input-target-link-"]');
            employeeLinks.forEach(link => {
                const url = new URL(link.href);
                url.searchParams.set('year', year);
                url.searchParams.set('semester', semester);
                link.href = url.toString();
            });

            const url = new URL(inputTargetLink.href);
            url.searchParams.set('year', year);
            url.searchParams.set('semester', semester);
            inputTargetLink.href = url.toString();

        }

        // Save the dropdown values to localStorage on change
        yearDropdown.addEventListener('change', function() {
            localStorage.setItem('selectedYear', this.value);
            updateLinks();
        });

        semesterDropdown.addEventListener('change', function() {
            localStorage.setItem('selectedSemester', this.value);
            updateLinks();
        });

        // Initial update of links
        updateLinks();
    });
</script>