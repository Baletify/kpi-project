<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        @php
            $currentYear = Carbon\Carbon::now()->year;
            $startYear = 2024; 
            $endYear = $currentYear + 2;
        @endphp
        <div class="flex justify-between">
            <div class="p-0">
                <span class="font-bold text-2xl">Input Target & Upload Program</span>
            </div>
            <div class="flex justify-end">
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
                  <div class="relative mt-1 rounded-md mb-1">
                    <button class="p-2 bg-blue-600 my-2 rounded-md">
                        <a id="input-target-link" href="{{ route('target.showDept', 'department=' . $departments->first()->department_id ?? '' ) }}" >
                            <span class="text-white">Input Target Dept</span>
                          </a>
                    </button>
                </div>
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
                    <a id="employee-link-{{ $department->employee_id }}" href="{{ route('target.show', 'employee=' . $department->employee_id) }}">
                      <span class="text-blue-500 hover:underline">Input Target Individu</span>
                    </a>
                </div>
                </td>
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2 text-center">
                    @if(!$department->file)
                    <a href="{{ route('action-plan.addEmployeeFile', $department->employee_id) }}">
                        <i class="ri-add-line bg-green-600 text-white text-sm p-0.5 rounded-sm"></i>
                       </a>
                     @endif
                    @if ($department->file)
                   <a href="{{ route('action-plan.showFile', $department->file) }}" target="_blank">
                    <i class="ri-eye-fill text-sm p-0.5 bg-blue-600 text-white rounded-sm"></i>
                   </a>
                   <a href="{{ route('action-plan.editFile', $department->action_plan_id) }}">
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
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearDropdown = document.getElementById('year');
        const semesterDropdown = document.getElementById('semester');
        const inputTargetLink = document.getElementById('input-target-link');

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
            const employeeLinks = document.querySelectorAll('a[id^="employee-link-"]');
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