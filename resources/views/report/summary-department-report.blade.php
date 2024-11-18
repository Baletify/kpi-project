<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="mb-2">
            <div class="mt-1">
                <span class="text-gray-600 p-1 text-[16px]">
                    PT. BRIDGESTONE KALIMANTAN PLANTATION
                </span>
            </div>
            <div class="">
                <span class="text-gray-600 p-1 text-2xl font-bold">
                    Summary KPI Report
                </span>
            </div>
            <div class="mt-1 pl-1">
                <span class="text-gray-600">Dept: IT</span>
            </div>
            <div class="pl-1">
                <span class="text-gray-600">Periode: 2025</span>
            </div>
        </div>
       
        <table class="w-full bg-white">
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700" rowspan="2">No.</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700" rowspan="2" >Dept</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700" rowspan="2">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700" rowspan="2">Nama</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700" rowspan="2">Posisi</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700" colspan="3">Bobot Pencapaian</th>
              <tr>
               <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700 text-center">Semester 1</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700 text-center">Semester 2</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700 text-center">Rata Rata</td>
              </tr>

              @php
                  $i = 0;
              @endphp
              @foreach ($employees as $employee)
              <tr>
                @php
                    $i++;
                    $semester1TotalWeight = $employeeTotals[$employee->employee_id]['semester_1'];
                    $semester2TotalWeight = $employeeTotals[$employee->employee_id]['semester_2'];
                    $averageWeight = ($semester1TotalWeight + $semester2TotalWeight) / 2;
                @endphp
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center">{{ $i }}</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">{{ $employee->dept }}</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">{{ $employee->nik }}</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">{{ $employee->name }}</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">{{ $employee->occupation }}</td>
                @if ($semester1TotalWeight > 0)
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center">{{ number_format($semester1TotalWeight, 2) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center"></td>
                @endif
                @if ($semester2TotalWeight > 0)
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center">{{ number_format($semester2TotalWeight, 2) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center"></td>
                @endif
                @if ($averageWeight > 0)
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center">{{ number_format($averageWeight, 2) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center"></td>
                @endif
              </tr>
              @endforeach
        </table>
    </div>
</x-app-layout>