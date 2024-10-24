<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <div class="p-5 mb-3 flex">
            <select name="year" id="year">
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
            <div class="mx-3 p-3 bg-blue-600 border text-white">
                <button type="submit" class="">Filter</button>
            </div>
        </div>
        <table class="w-full bg-white">
            @php
                $i = 0;
                $months = [
                    '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', 
                    '05' => 'May', '06' => 'Jun'
                ];
            @endphp
            <tr>
                <th style="width: 3%;" class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">No.</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Kode KPI</th>
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Indikator</th>
                @foreach ($months as $monthName)
                    <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">{{ $monthName }}</th>
                @endforeach
                <th class="border-2 border-gray-400 text-[13px] uppercase tracking-wide font-medium text-gray-600 py-1 bg-yellow-200">Aksi</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @forelse ($targets as $target)
                @php
                    $i++;
                @endphp
                <tr>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2 text-center">{{ $i }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2">{{ $target->code }}</td>
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2">{{ $target->indicator }}</td>
                    @foreach ($months as $month => $monthName)
                        @php
                            $actual = $actuals->first(function($item) use ($target, $month) {
                                return \Carbon\Carbon::parse($item->date)->format('m') == $month && $item->indicator == $target->indicator;
                            });
                        @endphp
                        @if ($actual)
                            <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2 text-center">OK</td>
                        @else
                            <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2"></td>
                        @endif
                    @endforeach
                    <td class="border-2 border-gray-400 text-[10px] tracking-wide  py-0 px-2 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ url('/actual/input-actual-achievement/edit/' . $target->id) }}">
                                <i class="ri-edit-2-line bg-yellow-400 text-sm border border-gray-200 shadow-black "></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="border-2 border-gray-400 tracking-wide  py-0 px-2 text-center">Data Tidak ditemukan</td>
                </tr>
            @endforelse
        </table>
    </div>
</x-app-layout>