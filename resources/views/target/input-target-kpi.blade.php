<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
        <div class="justify-end">
            <div class="mb-2 mt-2">
                @php
                    $employeeQuery = request()->query('employee');
                    $yearQuery = request()->query('year');
                    $semesterQuery = request()->query('semester');
                @endphp
            </div>
        </div>
        <div class="pl-1">
            <span class="font-bold text-xl">Target KPI Tahun {{ $yearQuery }}</span>
        </div>
        <div class="grid grid-cols-4">
            <div class="p-1">
                <table>
                    <tr>
                        <td style="width: 6%" class="text-[14px] tracking-wide font-medium text-gray-600 ">Dept</td>
                        <td style="width: 2%" class="text-[14px] tracking-wide font-medium text-gray-600 ">:</td>
                        <td class="text-[14px] tracking-wide font-medium text-gray-600 ">{{ $employee->department }}</td>
                    </tr>
                    <tr>
                        <td style="width: 6%" class="text-[14px] tracking-wide font-medium text-gray-600 ">NIK</td>
                        <td style="width: 2%" class="text-[14px] tracking-wide font-medium text-gray-600 ">:</td>
                        <td class="text-[14px] tracking-wide font-medium text-gray-600 ">{{ $employee->nik }}</td>
                    </tr>
                </table>
            </div>
            <div class="p-1">
                <table>
                    <tr>
                        <td style="width: 6%" class="text-[14px] tracking-wide font-medium text-gray-600 px-1">Nama</td>
                        <td style="width: 2%" class="text-[14px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[14px] tracking-wide font-medium text-gray-600 px-1">{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 6%" class="text-[14px] tracking-wide font-medium text-gray-600 px-1">Posisi</td>
                        <td style="width: 2%" class="text-[14px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[14px] tracking-wide font-medium text-gray-600 px-1">{{ $employee->occupation }}</td>
                    </tr>
                </table>
            </div>
            <div class="p-1">
            </div>
            <div class="flex justify-end items-center">
                <div class="relative mt-0 rounded-md">
                    <form action="{{ route('target.show') }}" method="GET">
                        <input type="hidden" name="employee" id="employee" value="{{ $employeeQuery }}">
                        <input type="hidden" name="year" id="year" value="{{ $yearQuery }}">
                    <div class="mt-2 mb-2 mx-2">
                        <select name="semester" id="semester" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">-- Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  <div class="mt-1 rounded-md mb-1">
                    <button class="p-2 bg-blue-600 my-2 rounded-md text-white">
                        Filter
                    </button>
                </div>
                </form>
                <div class="">
                    <a href="{{ route('target.showImport', 'semester=' . $semesterQuery . '&employee=' . $employeeQuery . '&year=' . $yearQuery) }}" class="p-1 mx-2 bg-blue-500 py-2 items-center rounded-md">
                    <i class="ri-import-line text-2xl text-white"></i>
                    <span class="font-medium text-white">Import</span>
                    </a>
                </div>
            </div>

        </div>
        <table class="w-full table-auto">
            <tr>
                <th style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Kode KPI</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700" style="width: 15%">KPI</th>
                <th style="width: 22%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Cara Menghitung</th>
                <th style="width: 22%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Data Pendukung</th>
                <th style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Trend</th>
                <th style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Periode Review</th>
                <th style="width: 3%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Unit</th>
                <th style="width: 3%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Bobot "%"</th>
                @php
            $currentSemester = request()->query('semester');
            $months = [];
        
            if ($currentSemester == 1) {
                $months = [
                    '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', 
                    '5' => 'May', '6' => 'Jun'
                ];
            } else {
                $months = [
                    '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', 
                    '11' => 'Nov', '12' => 'Dec'
                ];
            }
            @endphp
            
            @foreach ($months as $month)

                <th style="width: 4%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">{{ $month }}</th>
                
            @endforeach
                {{-- <th class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-1 bg-blue-700">Aksi</th> --}}
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($targets as $target)
            @php
            $i++
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100'}}">
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0">{{ $target->code }}</td>
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0">{{ $target->indicator }}</td>
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0 text-justify">{{ $target->calculation }}</td>
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0">
                    {{ $target->supporting_document }}
                </td>
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0">
                    {{ $target->trend }}
                </td>
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0 text-center">{{ $target->period }}</td>
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0">{{ $target->unit }}</td>
                <td class="border-2 border-gray-400 text-[10px] tracking-wide px-2 py-0 text-center">{{ $target->weighting }}</td>

                @php
                $isPercentage = $target->unit === '%';
                $isRp = $target->unit === 'Rp';
                $targetColumn = 'target_' . $month
                @endphp

                @if ($currentSemester == 1)
                @foreach (range(1, 6) as $month)
                    <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                        {{ $isPercentage && $target->{'target_' . $month} !== null ? $target->{'target_' . $month} * 100 . '%' : ($isRp ? ($target->{'target_' . $month} !== null ? number_format($target->{'target_' . $month}) : '') : ($target->{'target_' . $month} !== null ? $target->{'target_' . $month} : '')) }}
                    </td>
                @endforeach
                @else
                @foreach (range(7, 12) as $month)
                    <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                        {{ $isPercentage && $target->{'target_' . $month} !== null ? $target->{'target_' . $month} * 100 . '%' : ($isRp ? ($target->{'target_' . $month} !== null ? number_format($target->{'target_' . $month}) : '') : ($target->{'target_' . $month} !== null ? $target->{'target_' . $month} : '')) }}
                    </td>
                @endforeach
                @endif
                </tr>
            @empty
            <tr>
                <td colspan="16" class="border-2 border-gray-400 tracking-wide  py-0 px-2 text-center">Data Tidak ditemukan</td>
            </tr>
            @endforelse
        </table>
    </div>
</x-app-layout>