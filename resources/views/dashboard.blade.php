<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 px-2">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-md border border-gray-200 p-6 mt-2">
                <div class="flex justify-between">
                    <div>
                        <i class="ri-group-fill text-xl"></i>
                        <div class="text-2xl font-semibold mb-1">Manager</div>
                    </div>
                    <div class="grid lg:grid-cols-1 w-24">
                    <div class=" text-sm font-medium text-gray-500">Total: </div>
                    <div class=" text-sm font-medium text-gray-500">Aktual: </div>
                </div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-200 p-6 mt-2">
                <div class="flex justify-between">
                    <div>
                        <i class="ri-team-fill text-2xl"></i>
                        <div class="text-xl font-semibold mb-1">Asst Manager</div>
                    </div>
                    <div class="grid lg:grid-cols-1 w-24">
                        <div class=" text-sm font-medium text-gray-500">Total: </div>
                        <div class=" text-sm font-medium text-gray-500">Aktual: </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-200 p-6 mt-2">
                <div class="flex justify-between">
                    <div>
                        <i class="ri-bar-chart-2-fill text-2xl"></i>
                        <div class="text-xl font-semibold mb-1">Monthly</div>
                    </div>
                    <div class="grid lg:grid-cols-1 w-24">
                        <div class=" text-sm font-medium text-gray-500">Total: </div>
                        <div class=" text-sm font-medium text-gray-500">Aktual: </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class=" bg-gray-100 mt-4 grid lg:grid-cols-2 border-gray-200 shadow-md shadow-black/10 rounded-md gap-4">
            <div class="p-1 bg-gray-100 mt-2 grid lg:grid-cols-2 border-gray-200 rounded-md gap-4 col-span-1">
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Departemen</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                  <div class="p-1 bg-gray-100 mt-2 grid lg:grid-cols-2 border-gray-200 rounded-md gap-4">
                    <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Bulan</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Tahun</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Search</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
            </div>
            <div class="p-1 bg-gray-100 mt-2 grid lg:grid-cols-1 border-gray-200 rounded-md gap-4">
                <div class="bg-blue-800"></div>
                
            </div>
            <div class=" py-32 mb-2 ml-2 bg-black"></div>
            <div class="bg-green-800"></div>
        </div>
        </div>

    </div>
</x-app-layout>