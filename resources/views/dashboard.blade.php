<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 px-2">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
        <div class="w-full">
            <div class="pl-2 bg-gray-100 mt-4 grid lg:grid-cols-2 border-gray-200 shadow-md shadow-black/10 rounded-md gap-4">
            <div class="p-1 bg-gray-200 mt-2 grid lg:grid-cols-2 border-gray-200 rounded-md gap-4">
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Departemen</span>  
                    <form action="{{ url('dashboard') }}" method="GET">
                    <div class="pl-3 mb-3">
                        <select name="department" id="department" class=" w-56">
                            <option value="">-- Pilih Departemen --</option>
                            <option value="Enviro">Enviro</option>
                            <option value="BSKP">BSKP</option>
                            <option value="HR">HR</option>
                            <option value="IT">IT</option>
                        </select>
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Filter</button>
                    </div>
                </form>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                  <div class="p-1 bg-gray-200 mt-2 grid lg:grid-cols-2 border-gray-200 rounded-md ">
                    <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Bulan</span>  
                    <div class="pl-2 mb-3">
                        <select name="year" id="year" class=" w-28">
                            <option value="">-- Bulan --</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Tahun</span>  
                    <div class="pl-2 mb-3">
                        <select name="year" id="year" class=" w-28">
                            <option value="">-- Tahun --</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  <div class="relative mt-0 pl-3 rounded-md">  
                    <button class="bg-blue-500 text-white p-2 rounded-md">Filter</button>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Search</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="" value="">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
            </div>
            <div class="p-1 bg-gray-100 mt-2 grid lg:grid-cols-1 border-gray-200 rounded-md gap-4">
                <div class="bg-gray-200 rounded-md">
                    <div class="px-2 py-2">
                        <span class="p-4 font-bold text-xl">Notifikasi:</span>
                    </div>
                    
                </div>
                
            </div>
            <div class="mb-2 ml-2  bg-gray-200 rounded-md min-h-[200px]">
                <div class="px-2 py-1">
                    <span class="p-4 font-bold text-xl">Daftar Karyawan</span>
                </div>
                <div class="py-2 px-2 overflow-y-auto max-h-[240px]">
                    <table class="table-auto w-full">
                        <tr>
                            <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200">No.</th>
                            <th style="width: 45%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200">Nama</th>
                            <th style="width: 20%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200">Posisi</th>
                            <th style="width: 15%;" class="border-2 border-gray-400 text-[14px] uppercase tracking-wide font-medium text-gray-600 py-1 px-4 bg-yellow-200">Dept</th>
                            
                        </tr>
                        @php
                        $i = 0;
                    @endphp
                    @forelse ($employees as $employee)
                    @php
                        $i++;
                    @endphp
                        <tr>
                            <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-center">{{ $i }}</td>
                            <td class="border-2 border-gray-400 tracking-wide px-2 py-0">{{ $employee->name }}</td>
                            <td class="border-2 border-gray-400 tracking-wide px-2 py-0">{{ $employee->occupation }}</td>
                            <td class="border-2 border-gray-400 tracking-wide px-2 py-0">{{ $employee->department }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="16" class="border-2 border-gray-400 tracking-wide  py-0 px-2 text-center">Data Tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            {{-- <div class="bg-green-800 mb-2"></div> --}}
        </div>
        </div>

    </div>
</x-app-layout>