<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        @php
        $currentYear = Carbon\Carbon::now()->year;
            $startYear = 2024; 
            $endYear = $currentYear + 2;
            $role = auth()->user()->role;
        @endphp
        <div class="flex justify-between">
            <div class="p-0">
                <span class="font-bold text-2xl">Lihat Data Pendukung Departemen</span>
            </div>
                    <div class="flex justify-end">
                        <div class="relative mt-1 rounded-md">
                            <div class="mt-2 mb-1 mx-0.5">
                                <select name="year" id="year" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="">-- Tahun --</option>
                                    @for ($year = $startYear; $year <= $endYear; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                          </div>
                    </div>
            </div>
            <div class="p-0">
                <button type="button" class="p-2 bg-blue-500 text-white rounded-md" onclick="history.back()">
                    Back
                </button>
            </div>

        <div class="flex justify-center mt-2 mb-2">
            <table class="w-1/2 table-auto">
                <tr>
                    <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">No.</th>
                    <th style="width: 15%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Dept</th>
                    <th style="width: 10%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Kode Dept</th>
                    <th style="width: 20%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Aksi</th>
                </tr>
                @php
                    $i = 0;
                @endphp
                @forelse ($departments as $department)
                    @php
                        $i++
                    @endphp
                    <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}">
                        <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">{{ $i }}</td>
                        <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->name }}</td>
                        <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">{{ $department->code }}</td>
                        <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0">
                            <div class="flex justify-center gap-3 my-0.5">
                                <a href="" id="employee-link-{{ $department->id }}" class="rounded-md text-blue-500 hover:underline">Lihat Data Pendukung</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="5" class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">Tidak Ditemukan</td>
                    </tr>
                @endforelse

                
            </table>
        </div>
        
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearDropdown = document.getElementById('year');
        
        // Set the dropdown values from localStorage if they exist
        const savedYear = localStorage.getItem('selectedYear');
        if (savedYear) {
            yearDropdown.value = savedYear;
        }

        // Save the dropdown values to localStorage on change
        yearDropdown.addEventListener('change', function() {
            const year = this.value;
            localStorage.setItem('selectedYear', year);
            updateLinks();
        });


        function updateLinks() {
            const year = yearDropdown.value;
            const links = document.querySelectorAll('a[id^="employee-link-"]');
            links.forEach(link => {
                const url = new URL(link.href);
                url.searchParams.set('year', year);
                link.href = url.toString();
            });
        }

        // Initial update of links
        updateLinks();
    });
</script>