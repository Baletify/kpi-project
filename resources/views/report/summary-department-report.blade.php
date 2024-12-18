<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="mb-2">
            <div class="mt-1">
                <span class="text-gray-600 p-1 text-xl">
                    PT. BRIDGESTONE KALIMANTAN PLANTATION
                </span>
            </div>
            <div class="">
                <span class="text-gray-600 p-1 text-2xl font-bold">
                    Summary KPI Department Report
                </span>
            </div>
            <div class="pl-1">
                <span class="text-gray-600">Periode: {{ request()->query('year') }}</span>
            </div>
        </div>
        <div class="flex justify-end">
            <form action="{{ url('/report/summary-department-report') }}" method="GET">
            <div class="p-0 flex justify-between gap-x-1">
                <div class="relative mt-1 rounded-md">
                    <div class="mt-2">
                        <select name="year" id="year" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="{{ request()->query('year') }}">-- Tahun --</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <div class="mt-2 mb-1">
                        <select name="semester" id="semester" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">-- Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                <div class="relative mt-1 rounded-md">
                    <div class="mt-2 mb-1">
                        <select name="department" id="department" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">-- Department --</option>
                            @foreach ($allDept as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                <div class="relative mt-1 rounded-md">
                    <div class="mt-2 mb-1">
                        <select name="occupation" id="occupation" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">-- Posisi --</option>
                            @foreach ($allOccupation as $item)  
                            <option value="{{ $item->occupation }}">{{ $item->occupation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  <div class="my-2">
                    <button type="submit" class="rounded-md bg-blue-500 text-white p-2">Filter</button>
                </div>
            </div>
            </form>
        </div>
       
        <table class="w-full bg-white">
                <th style="width: 3%;" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2">No.</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2" >Dept</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2">NIK</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2">Nama</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2">Posisi</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" colspan="3">Bobot Pencapaian</th>
              <tr>
               <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Semester 1</td>
                <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Semester 2</td>
                <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Rata Rata</td>
              </tr>

              @php
                  $i = 0;
              @endphp
              @foreach ($employees as $employee)
              @php
                  $i++;
                  $semester1TotalWeight = $employeeTotals[$employee->employee_id]['semester_1'];
                  $semester2TotalWeight = $employeeTotals[$employee->employee_id]['semester_2'];
                  $averageWeight = ($semester1TotalWeight + $semester2TotalWeight) / 2;
                  @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100' }}">
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2">{{ $employee->dept }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2">{{ $employee->nik }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2">{{ $employee->name }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2">{{ $employee->occupation }}</td>
                @if ($semester1TotalWeight > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($semester1TotalWeight, 2) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif
                @if ($semester2TotalWeight > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($semester2TotalWeight, 2) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif
                @if ($averageWeight > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($averageWeight, 2) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif
              </tr>
              @endforeach
        </table>
    </div>
</x-app-layout>