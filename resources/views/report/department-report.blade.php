<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="mb-2">
            <div class="mt-1">
                <span class="text-gray-600 p-1 uppercase text-[16px]">
                    PT. BRIDGESTONE KALIMANTAN PLANTATION
                </span>
            </div>
            <div class="">
                <span class="text-gray-600 p-1 text-2xl font-bold">
                    Summary KPI Report
                </span>
            </div>
            <div class="mt-1 pl-1">
                <span class="text-gray-600">Dept: IT</span>
            </div>
            <div class="pl-1">
                <span class="text-gray-600">Periode: Semester 1 - 2025</span>
            </div>
        </div>
       
        <table class="w-full bg-white">
                <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200" rowspan="2">No.</th>
                <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200" rowspan="2" >Dept</th>
                <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200" rowspan="2">NIK</th>
                <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200" rowspan="2">Nama</th>
                <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200" rowspan="2">Posisi</th>
                <th class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200" colspan="3">Bobot Pencapaian</th>
              <tr>
               <td class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200 text-center">Semester 1</td>
                <td class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200 text-center">Semester 2</td>
                <td class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200 text-center">Rata Rata</td>
              </tr>
              <tr>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4 text-center">1</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">IT</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">XXX-XXX</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">Mr-XXX</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4">IT Staff</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4"></td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4"></td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-600 py-1 px-4"></td>
              </tr>
        </table>
    </div>
</x-app-layout>