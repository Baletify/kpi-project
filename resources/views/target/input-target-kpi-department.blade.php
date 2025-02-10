<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
        @php
            $yearQuery = request()->query('year');
            $departmentQuery = request()->query('department');
        @endphp
        <div class="p-0">
            <span class="font-bold text-2xl">Target KPI Departemen {{ $departments->name }} Tahun {{ $yearQuery }}</span>
        </div>
        <div class="flex justify-end">
            <div class="relative mt-0 rounded-md">
                <form action="{{ route('target.showDept') }}" method="GET">
                    <input type="hidden" name="department" id="department" value="{{ $departmentQuery }}">
                    <input type="hidden" name="year" id="year" value="{{ $yearQuery }}">
                <div class="mt-3 mx-2">
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
            </form>
            </div>
            @php
                $currentSemester = request()->query('semester');
                $department = request()->query('department');
                $year = request()->query('year');
            @endphp
            <div class="mt-3">
                <a href="{{ route('target.showImportDept', 'semester=' . $currentSemester . '&department=' . $department . '&year=' . $year) }}" class="p-1 mx-2 bg-green-600 py-2 items-center rounded-md">
                    <i class="ri-file-excel-2-line text-2xl text-white"></i>
                    <span class="font-medium text-white">Upload Excel</span>
                </a>
            </div>
        </div>
        <table class="w-full table-auto">
            <tr>
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Kode KPI</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700" style="width: 13%">KPI</th>
                <th style="width: 18%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Cara Menghitung</th>
                <th style="width: 18%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Data Pendukung</th>
                <th style="width: 3%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Trend</th>
                <th style="width: 3%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Periode Review</th>
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Unit</th>
                <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Bobot "%"</th>
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

                <th style="width: 5%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">{{ $month }}</th>
                
            @endforeach
                {{-- <th style="width: 4%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-1 bg-blue-700">Aksi</th> --}}
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
                $isKg = $target->unit === 'Kg';
                $targetColumn = 'target_' . $month;
                // Helper function to format values based on the number of digits before the decimal point
                $formatKgValue = function ($value) {
                    // Convert the value to a string
                    $valueStr = (string) $value;

                    // Find the position of the decimal point
                    $decimalPos = strpos($valueStr, '.');

                    // If there is no decimal point, return the value as is
                    if ($decimalPos === false) {
                        return number_format($value);
                    }

                    // Get the number of digits before the decimal point
                    $digitsBeforeDecimal = $decimalPos;

                    // If there are more than 3 digits before the decimal point, return the value as is
                    if ($digitsBeforeDecimal > 3) {
                        return number_format($value);
                    }

                    // Otherwise, format the value with 1 decimal place
                    return number_format($value, 1);
                }
                @endphp

                @if ($currentSemester == 1)
                @foreach (range(1, 6) as $month)
                @php
                $targetColumn = 'target_' . $month;
                @endphp
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    @if ($target->{$targetColumn} !== null)
                    @php
                    $floatValue = floatval($target->{$targetColumn});
                    $formattedValue = $formatKgValue($floatValue);
                    @endphp
                    @if ($isPercentage)
                    @php
                    $percentageValue = $floatValue * 100;
                    @endphp
                        {{ $percentageValue . '%' }}
                    @elseif ($isRp || $target->unit === 'Rp.')
                        {{ number_format($floatValue) }}
                    @elseif ($isKg)
                    {{ $formattedValue }}
                    @else
                        {{ $floatValue }}
                    @endif
                @else
                    <span></span>
                @endif
                </td>
                @endforeach
                @else
                @foreach (range(7, 12) as $month)
                @php
                $targetColumn = 'target_' . $month;
                @endphp
                <td class="border-2 border-gray-400 text-[11px] tracking-wide px-2 py-0 text-center">
                    @if ($target->{$targetColumn} !== null)
                    @php
                    $floatValue = floatval($target->{$targetColumn});
                    $formattedValue = $formatKgValue($floatValue);
                    @endphp
                    @if ($isPercentage)
                    @php
                    $percentageValue = $floatValue * 100;
                    @endphp
                        {{ $percentageValue . '%' }}
                    @elseif ($isRp || $target->unit === 'Rp.')
                        {{ number_format($floatValue) }}
                    @elseif ($isKg)
                    {{ $formattedValue }}
                    @else
                        {{ $floatValue }}
                    @endif
                @else
                    <span></span>
                @endif
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