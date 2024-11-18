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
                <span class="text-gray-600 font-bold text-xs text-center">Periode: Semester 2 2024</span>
            </div>
            <div class="">
                <span class="text-gray-600 font-bold text-xs text-center">Divisi: IT</span>
            </div>
        </div>

        <div class="p-1 mt-5">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2">No.</th>
                        <th style="width: 30%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >KPI</th>
                        <th style="width: 8%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >Periode Review</th>
                        <th style="width: 5%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >Unit</th>
                        <th style="width: 6%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2" >Bobot "%"</th>
                        <th style="width: 8%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2"></th>
                        <th style="width: 40%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" colspan="7">Target & Actual KPI</th>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" rowspan="2">Bobot Pencapaian</th>
                    </tr>
                    <tr>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >Jan</th>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >Feb</th>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >Mar</th>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >Apr</th>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >May</th>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >Jun</th>
                        <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-1 bg-blue-700" >Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    <tr>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5">{{ $i }}</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="5"></td>
                    </tr>
                    
                    <tr>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Target</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center" rowspan="4"></td>
                    </tr>
                    <tr>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Actual</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">%</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center">Rekaman</td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                        <td class="border-2 border-gray-400 text-[10px] tracking-wide font-medium text-gray-600 py-0 px-1 text-center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>