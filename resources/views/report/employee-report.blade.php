<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="p-1">
            <span class="text-gray-600 font-bold text-lg">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
        </div>
        <div class="justify-center flex flex-col items-center">
            <div class="">
                <span class="text-gray-600 font-bold text-lg text-center">Key Performance Indicator</span>
            </div>
            <div class="">
                @php
                
                $year = \Carbon\Carbon::parse($actuals->first()->date)->year;
                @endphp
                <span class="text-gray-600 font-bold text-xs text-center">Periode: Semester {{ $actuals->first()->semester }} {{ $year }}</span>
            </div>
        </div>
        <div class="grid grid-cols-7 p-1">
            <div class="mx-1">
                <table class="table-auto w-full">
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">Dept</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->department }}</td>
                    </tr>
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">NIK</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->nik }}</td>
                    </tr>
                </table>
            </div>
            <div class="mx-1">
                <table class="table-auto w-full">
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">Nama</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 6%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">Posisi</td>
                        <td style="width: 2%" class="text-[13px] tracking-wide font-medium text-gray-600 px-1">:</td>
                        <td class="text-[13px] tracking-wide font-medium text-gray-600 px-1">{{ $actuals->first()->occupation }}</td>
                    </tr>
                </table>
            </div>
            
        </div>
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
                
                @foreach ($actuals as $actual)
            
                <tr>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $actual->kpi_code }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $actual->kpi_item }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                </tr>
                
                <tr>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Target</td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200\ border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="4"></td>
                </tr>
                <tr>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Actual</td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                <tr>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">%</td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2  border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                <tr>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Rekaman</td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    <td class="border-2 bg-gray-200 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>