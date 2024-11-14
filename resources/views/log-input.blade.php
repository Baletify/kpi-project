<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-60 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="p-2">
            <div class="px-1">
                <span class="font-medium text-gray-600 text-sm">PT BRIDGESTONE KALIMANTAN PLANTATION</span>
            </div>
            <div class="px-1">
                <span class=" font-bold text-gray-600 text-2xl">LOG INPUT KPI</span>
            </div>
        </div>

        <table class="w-full bg-white table-fixed">
            <tr>
                {{-- <th style="width: 2%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700" rowspan="2">No.</th> --}}
                <th style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700" rowspan="2">Dept</th>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700" rowspan="2">Jumlah KPI</th>
                @foreach ($months as $month)
                    <th style="width: 10%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700" colspan="3">
                        {{ \Carbon\Carbon::create()->month($month)->format('M') }}
                    </th>
                @endforeach

            </tr>
            <tr>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Not OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Last Input</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Not OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Last Input</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Not OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Last Input</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Not OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Last Input</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Not OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Last Input</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Not OK</th>
                <th style="width: 13%" class="border-2 border-gray-400 text-[12px] tracking-wide font-medium text-white py-0 bg-blue-700">Last Input</th>

            </tr>
 
            @php
                $i = 0;
            @endphp
            @foreach ($departments as $department => $items)
            @php
            $i++;
            @endphp
            <tr class="{{ $i % 2 === 0 ? 'bg-gray-100' : 'bg-gray-300' }}"> 

                {{-- <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0 text-center">{{ $i }}</td> --}}
                <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0">{{ $department }}</td>
                @foreach ($months as $month)
                    @php
                        $item = $items->first(function($item) use ($month) {
                            return \Carbon\Carbon::parse($item->created_at)->month == $month;
                        });
                    @endphp
                    <td class="border-2 border-gray-400 tracking-wide text-[11px] py-0">
                        {{ $item ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '' }}
                    </td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>