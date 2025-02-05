<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
        <table class="w-full table-fixed">
            <tr class="bg-blue-700">
                <th style="width: 4%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">No.</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Dept</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">PIC Input</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Check 1</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Check 2</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Approved</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Final Check</th>
            </tr>
            @php
            $i = 0;
            @endphp
            @foreach ($departments as $department)
                @php
                $i++;
                $individual = $individuals->first(function ($item) use ($department) {
                    return $item->id == $department->id;
                });
                

                @endphp
            <tr class="{{ $i % 2 == 0 ?  'bg-white' : 'bg-blue-100' }}">
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 text-center py-0 px-4">{{ $i }}</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">{{ $department->name }}</td>

                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">
                    {{ ($individual->name ?? '') ? 'Input Mandiri' : 'Clerk & Opas' }}
                </td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">{{ $department->check_1 ?? '-' }}</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">
                    {{ $department->check_2 ?? '-' }}
                </td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">
                    {{ $department->mng_approve ?? '-' }}
                </td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">HRD Spv</td>
            </tr>
            @endforeach

        </table>
    </div>
</x-app-layout>