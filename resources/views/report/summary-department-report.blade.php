<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        @php
            $currentYear = Carbon\Carbon::now()->year;
            $startYear = 2024; 
            $endYear = $currentYear + 2;
        @endphp
        <div class="flex justify-between">
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
                <form action="{{ route('report.summaryDept') }}" method="GET">
                <div class="p-0 flex justify-between gap-x-1">
                    <div class="relative mt-1 rounded-md">
                        <div class="mt-2">
                            <select name="year" id="year" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="{{ request()->query('year') }}">-- Tahun --</option>
                                @for ($year = $startYear; $year <= $endYear; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
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
                            <select name="status" id="status" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="">-- Status --</option>
                                @foreach ($allOccupation as $item)  
                                <option value="{{ $item->status }}">{{ $item->status }}</option>
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
        </div>
       <div class="p-0">
        <table class="w-full bg-white table-fixed">
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2" style="width: 3%">No.</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2" style="width: 10%">Dept</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2" style="width: 6%">NIK</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2" style="width: 23%">Nama</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2" style="width: 12%">Posisi</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" colspan="3">Pencapaian KPI Dept 30%</th>
                <th class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" colspan="3">Pencapaian KPI Individu 70%</th>
                <th style="width: 6%" class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700" rowspan="2">Total Rata Rata</th>
              <tr>
               <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Semester 1</td>
                <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Semester 2</td>
                <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Rata Rata</td>
               <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Semester 1</td>
                <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Semester 2</td>
                <td class="border-2 border-gray-400 text-[13px] tracking-wide font-medium text-white py-0.5 px-2 bg-blue-700 text-center">Rata Rata</td>
              </tr>

              @php
                  $i = 0;
                  $startIndex = ($employees->currentPage() - 1) * $employees->perPage() + 1;
                  $totalSemester1Weight = 0;
                    $totalSemester2Weight = 0;
                    $totalSemester1DeptWeight = 0;
                    $totalSemester2DeptWeight = 0;
                    $totalWeightSum = 0;
                    $totalDeptWeightSum = 0;
                    $totalAllSum = 0;
              @endphp
              @foreach ($employees as $index => $employee)
              @php
                  $i++;

                //   dd($employee, $sumGroupSemester1);
                $employeeId = $employee->employee_id;
                $departmentId = $employee->department_id;

                $sumSemester1 = $sumGroupSemester1[$employeeId] ?? 0;
                $sumSemester2 = $sumGroupSemester2[$employeeId] ?? 0;
                $totalSumEmployee = $totalSumSemester[$employeeId] ?? 0;
                $sumSemester1Dept = $sumGroupSemester1Dept[$departmentId] ?? 0;
                $sumSemester2Dept = $sumGroupSemester2Dept[$departmentId] ?? 0;
                $totalSumDept = $totalSumSemesterDept[$departmentId] ?? 0;
                $totalAll = ($totalSumEmployee ?? 0) + ($totalSumDept ?? 0);

                $totalSemester1Weight += $sumSemester1;
                $totalSemester2Weight += $sumSemester2;
                $totalSemester1DeptWeight += $sumSemester1Dept;
                $totalSemester2DeptWeight += $sumSemester2Dept;
                $totalWeightSum += $totalSumEmployee;
                $totalDeptWeightSum += $totalSumDept;
                $totalAllSum += $totalAll;
                // dd($sumSemester1Dept, $sumSemester2Dept);
                  
              @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-100' }}">
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ $startIndex + $index }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2">{{ $employee->dept }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2" >{{ $employee->nik }}</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2">     
                    {{ $employee->name }}
                </td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2" >{{ $employee->occupation }}</td>
                @if ($sumSemester1Dept > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($sumSemester1Dept, 1) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif

                @if ($sumSemester2Dept > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($sumSemester2Dept, 1) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif
                
                @if ($totalSumDept > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalSumDept, 1) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif

                @if ($sumSemester1 > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($sumSemester1, 1) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif

                @if ($sumSemester2 > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($sumSemester2, 1) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif

                @if ($totalSumEmployee > 0)
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalSumEmployee, 1) }}%</td>
                @else
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                @endif

                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalAll, 1) }}%</td>
              </tr>
              @endforeach

              @if(request()->query('department'))
              <tr class="bg-gray-200">
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center"></td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center" colspan="4">Total</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalSemester1DeptWeight, 1) }}%</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalSemester2DeptWeight, 1) }}%</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalDeptWeightSum, 1) }}%</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalSemester1Weight, 1) }}%</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalSemester2Weight, 1) }}%</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalWeightSum, 1) }}%</td>
                <td class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-gray-600 py-0.5 px-2 text-center">{{ number_format($totalAllSum, 1) }}%</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="mt-5">
        <table class="w-full">
            
        </table>
    </div>
    
    {{-- Pagination --}}
    <div class="shadow-lg shadow-black/15 mb-2 mt-3">
        <div class="flex w-full items-center justify-between border-t border-gray-200 bg-white px-10 py-3 rounded-md">
            <div class="flex flex-1 justify-between sm:hidden">
                {{ $employees->links() }}
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{ $employees->firstItem() }}</span>
                        to
                        <span class="font-medium">{{ $employees->lastItem() }}</span>
                        of
                        <span class="font-medium">{{ $employees->total() }}</span>
                        results
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        @if ($employees->onFirstPage())
                            <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-default">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $employees->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
    
                        @foreach ($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
                            @if ($page == $employees->currentPage())
                                <span aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $page }}</span>
                            @elseif ($page == 1 || $page == $employees->lastPage() || ($page >= $employees->currentPage() - 1 && $page <= $employees->currentPage() + 1))
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $page }}</a>
                            @elseif ($page == $employees->currentPage() - 2 || $page == $employees->currentPage() + 2)
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 cursor-default">...</span>
                            @endif
                        @endforeach
    
                        @if ($employees->hasMorePages())
                            <a href="{{ $employees->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-default">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- end of pagination --}}
    </div>
</x-app-layout>