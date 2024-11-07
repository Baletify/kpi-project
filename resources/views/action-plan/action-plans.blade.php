<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <table class="w-full bg-white table-auto">
            <tr>
                <th style="width: 10%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Nama</th>
                <th style="width: 18%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Dept</th>
                <th style="width: 12%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Posisi</th>
                <th style="width: 14%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Status</th>
                <th style="width: 10%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-0 px-4 bg-blue-700">Aksi</th>
            </tr>
           @foreach ($employees as $employee)
            <tr> 
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2  text-center">{{ $employee->nik }}</td>
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2 ">{{ $employee->name }}</td>
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2 ">
                    {{ $employee->department }}
                </td>
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2 ">{{ $employee->occupation }}</td>
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2 ">
                    {{ $employee->file ? 'Sudah' : 'Belum' }}
                </td>
                <td class="border-2 text-[12px] border-gray-400 tracking-wide px-2 text-center">
                    @if(!$employee->file)
                    <a href="{{ url('action-plan/input-action-plan/' . $employee->id ) }}">
                        <i class="ri-add-line bg-green-600 text-white text-lg p-1 rounded-sm"></i>
                       </a>
                     @endif
                    @if ($employee->file)
                   <a href="{{ route('action-plan.showFile', $employee->file) }}" target="_blank">
                    <i class="ri-eye-fill text-lg bg-blue-600 text-white p-1 rounded-sm"></i>
                   </a>
                   <a href="{{ url('action-plan/input-action-plan/edit/' . $employee->action_plan_id) }}">
                    <i class="ri-edit-2-fill bg-yellow-400 text-lg shadow-black p-1 rounded-sm"></i>
                   </a>
                   @endif
                </td>
            @endforeach
            </tr>
        </table>
    </div>
</x-app-layout>