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
                    <div class=" text-sm font-medium text-gray-500">Total: {{ $managerCount }} </div>
                    <div class=" text-sm font-medium text-gray-500">Aktual: {{ $managerCountActual }} </div>
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
                        <div class=" text-sm font-medium text-gray-500">Total: {{ $assistantManagerCount }}</div>
                        <div class=" text-sm font-medium text-gray-500">Aktual: {{ $assistantManagerCountActual }} </div>
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
                        <div class=" text-sm font-medium text-gray-500">Total: {{ $totalEmployees }}</div>
                        <div class=" text-sm font-medium text-gray-500">Aktual: {{ $totalActualInputs }} </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="pl-2 bg-gray-100 mt-4 grid lg:grid-cols-2 border-gray-200 shadow-md shadow-black/10 rounded-md gap-4">
            <div class="p-1 bg-gray-200 mt-2 grid lg:grid-cols-2 border-gray-200 rounded-md gap-4">
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Departemen</span>  
                    <div class="pl-3 mb-3">
                        <select name="department" id="department" class=" w-56">
                            <option value="">-- Pilih Departemen --</option>
                            <option value="2">Enviro</option>
                            <option value="1">BSKP</option>
                            <option value="HR">HR</option>
                            <option value="3">IT</option>
                        </select>
                    </div>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                  <div class="p-1 bg-gray-200 mt-2 grid lg:grid-cols-2 border-gray-200 rounded-md ">
                    <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Semester</span>  
                    <div class="pl-2 mb-3">
                        <select name="semester" id="semester" class=" w-28">
                            <option value="">-- Semester --</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
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
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  </div>
                  
                </div>
                
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Search</span>
                        <input type="text" name="filterName" id="filterName" class="w-64 rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Masukkan Nama" value="" autocomplete="off">
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
            <div class="mb-2  bg-gray-200 rounded-md min-h-[200px]">
                <div class="px-2 py-1">
                    <span class="p-4 font-bold text-xl">Daftar Karyawan</span>
                </div>
                <div class="py-2 px-2 overflow-y-auto max-h-[240px]">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th style="width: 3%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">No.</th>
                            <th style="width: 45%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Nama</th>
                            <th style="width: 20%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Posisi</th>
                            <th style="width: 15%;" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">Dept</th> 
                        </tr>
                    </thead>
                    
                    <tbody id="employeeTableBody">

                    </tbody>
                    </table>
                </div>
                
            </div>
            
            {{-- <div class="bg-green-800 mb-2"></div> --}}
        </div>
        
        </div>
        <div class="">
            <span class="text-gray-700 italic">Note: Klik pada kolom Departemen atau Nama untuk melihat detail</span>
        </div>
        <div class=""> 
            <span class="text-red-600 text-xl">*</span>
            <span class="text-gray-700 italic">Pilih semester dan tahun untuk melihat detail KPI Individu</span>
        </div>
        
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
      function fetchData() {
        const department = document.getElementById('department').value;
        const name = document.getElementById('filterName').value;
        const year = document.getElementById('year').value;
        const semester = document.getElementById('semester').value;

        fetch(`{{ url('dashboard/filter') }}?department=${department}&name=${name}&semester=${semester}&year=${year}`)
          .then(response => response.json())
          .then(data => {
            const tbody = document.getElementById('employeeTableBody');
            tbody.innerHTML = '';

            if (data.length > 0) {
              data.forEach((item, index) => {
                const row = `<tr class="${index % 2 === 0 ? 'bg-gray-200' : 'bg-gray-100'}">
                  <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-center">${index + 1}</td>
                  <td class="border-2 border-gray-400 tracking-wide px-2 py-0">
                    <a href="/report/employee-report/${item.id}?semester=${semester}&year=${year}" class=" hover:underline">${item.name}</a>
                    </td>
                  <td class="border-2 border-gray-400 tracking-wide px-2 py-0">${item.occupation}</td>
                  <td class="border-2 border-gray-400 tracking-wide px-2 py-0"> <a href="/target/input-target-kpi-department?department=${item.department_id}" class=" hover:underline">${item.department}</a>
                    </td>
                </tr>`;
                tbody.innerHTML += row;
              });
              
            } else {
              tbody.innerHTML = '<tr><td colspan="4" class="border-2 border-gray-400 tracking-wide px-2 py-0 text-center">No data found</td></tr>';
            }
          });
      }

      document.getElementById('department').addEventListener('change', fetchData);
      document.getElementById('filterName').addEventListener('input', fetchData);
      document.getElementById('year').addEventListener('change', fetchData);
      document.getElementById('semester').addEventListener('change', fetchData);
    });
    </script>
</x-app-layout>