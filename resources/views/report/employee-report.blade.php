<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
    <div class="mx-1">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2">No.</th>
                    <th style="width: 30%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >KPI</th>
                    <th style="width: 8%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >Periode Review</th>
                    <th style="width: 5%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >Unit</th>
                    <th style="width: 6%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2" >Bobot "%"</th>
                    <th style="width: 8%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2"></th>
                    <th style="width: 40%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" colspan="7">Target & Actual KPI</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" rowspan="2">Bobot Pencapaian</th>
                </tr>
                <tr>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >Jan</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >Feb</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >Mar</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >Apr</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >May</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >Jun</th>
                    <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-1 bg-yellow-200" >Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($actuals as $actual)
                @php
                    $i++;
                @endphp
                <tr>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $i }}</td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $actual->kpi_item }}</td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                </tr>
                
                <tr>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Target</td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="4"></td>
                </tr>
                <tr>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Actual</td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                <tr>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">%</td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                <tr>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Rekaman</td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>