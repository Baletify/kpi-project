<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="flex mb-2">
            <div class="my-2">
                <a href="#" class="p-1 bg-blue-500 py-2 items-center rounded-md">
                    <i class="ri-import-line text-2xl text-white"></i>
                    <span class="font-medium text-white">Upload KPI Dept</span>
                </a>
            </div>
        </div>
        <table class="w-full bg-white table-auto">
            <tr>
                <th style="width: 10%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-0 px-4 bg-yellow-200">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-0 px-4 bg-yellow-200">Nama</th>
                <th style="width: 18%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-0 px-4 bg-yellow-200">Dept</th>
                <th style="width: 12%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-0 px-4 bg-yellow-200">Posisi</th>
                <th style="width: 14%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-0 px-4 bg-yellow-200">Status</th>
                <th style="width: 10%" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-0 px-4 bg-yellow-200">Aksi</th>
            </tr>
           
            <tr> 
                <td class="border-2 border-gray-400 tracking-wide px-2  text-center">XXX-CCC</td>
                <td class="border-2 border-gray-400 tracking-wide px-2 "></td>
                <td class="border-2 border-gray-400 tracking-wide px-2 "></td>
                <td class="border-2 border-gray-400 tracking-wide px-2 "></td>
                <td class="border-2 border-gray-400 tracking-wide px-2 "></td>
                <td class="border-2 border-gray-400 tracking-wide px-2 text-center">
                    <a href="">
                        <i class="ri-add-line bg-green-600 text-white text-lg p-1 rounded-sm"></i>
                       </a>
                   <a href="">
                    <i class="ri-eye-fill text-lg bg-blue-600 text-white p-1 rounded-sm"></i>
                   </a>
                   <a href="">
                    <i class="ri-edit-2-fill bg-yellow-400 text-lg shadow-black p-1 rounded-sm"></i>
                   </a>
                   
                </td>
               
            </tr>
        </table>
    </div>
</x-app-layout>