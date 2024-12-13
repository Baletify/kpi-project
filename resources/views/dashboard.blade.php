<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 px-2">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-gradient-to-bl from-[#3572EF] to-[#050C9C] rounded-md border border-gray-200 p-6 mt-2 shadow-md shadow-black/15">
                <div class="flex justify-between">
                    <div>
                        <i class="text-white ri-group-fill text-xl"></i>
                        <div class="text-white text-xl font-semibold mb-1">Manager</div>
                    </div>
                    <div class="grid lg:grid-cols-1 w-24">
                        <table>
                            <tr>
                                <td class="text-sm font-medium text-white" style="width: 50%">Total</td>
                                <td class="text-sm font-medium text-white">:</td>
                                <td class="text-sm font-medium text-white">{{ $managerCount }}</td>
                            </tr>
                            <tr>
                                <td class="text-sm font-medium text-white">Aktual</td>
                                <td class="text-sm font-medium text-white">:</td>
                                <td class="text-sm font-medium text-white">{{ $managerCountActual }} </td>
                            </tr>
                        </table>
                </div>
                </div>
            </div>
            <div class="bg-gradient-to-bl from-[#3572EF] to-[#050C9C] rounded-md border border-gray-200 p-6 mt-2 shadow-md shadow-black/15">
                <div class="flex justify-between">
                    <div>
                        <i class="text-white ri-team-fill text-2xl"></i>
                        <div class="text-white text-xl font-semibold mb-1">Asst Manager</div>
                    </div>
                    <div class="grid lg:grid-cols-1 w-24">
                        <table>
                            <tr>
                                <td class="text-sm font-medium text-white" style="width: 50%">Total</td>
                                <td class="text-sm font-medium text-white">:</td>
                                <td class="text-sm font-medium text-white">{{ $assistantManagerCount }}</td>
                            </tr>
                            <tr>
                                <td class="text-sm font-medium text-white">Aktual</td>
                                <td class="text-sm font-medium text-white">:</td>
                                <td class="text-sm font-medium text-white">{{ $assistantManagerCountActual }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-bl from-[#3572EF] to-[#050C9C] rounded-md border border-gray-200 p-6 mt-2 shadow-md shadow-black/15">
                <div class="flex justify-between">
                    <div>
                        <i class="ri-bar-chart-2-fill text-white text-2xl"></i>
                        <div class="text-white text-xl font-semibold mb-1">Monthly</div>
                    </div>
                    <div class="grid lg:grid-cols-1 w-24">
                        <table>
                            <tr>
                                <td class="text-sm font-medium text-white" style="width: 50%">Total</td>
                                <td class="text-sm font-medium text-white">:</td>
                                <td class="text-sm font-medium text-white">{{ $totalEmployees }}</td>
                            </tr>
                            <tr>
                                <td class="text-sm font-medium text-white">Aktual</td>
                                <td class="text-sm font-medium text-white">:</td>
                                <td class="text-sm font-medium text-white">{{ $totalActualInputs }}</td>
                            </tr>
                        </table>
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
                        <select name="department" id="department" class=" w-56 text-[12px]">
                            <option value="">-- Pilih Departemen --</option>
                            @foreach ($deptLists as $item)
                                
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                  <div class="p-1 bg-gray-200 mt-2 grid lg:grid-cols-2 border-gray-200 rounded-md ">
                    <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Semester</span>  
                    <div class="pl-2 mb-3">
                        <select name="semester" id="semester" class=" w-28 text-[12px]">
                            <option value="">-- Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                  <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Tahun</span>  
                    <div class="pl-2 mb-3">
                        <select name="year" id="year" class=" w-28 text-[12px]">
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
                    <div class="px-2 py-2 flex justify-between">
                        <div class="">
                            <p class="p-0.5 font-bold text-xl">Notifikasi:</p>
                        </div>
                        <div class="">
                            <a href="">
                                <p class="text-blue-500 hover:underline">See All</p>
                            </a>
                        </div>
                    </div>
                    <a href="">
                    <ul role="list" class="divide-y divide-gray-300 px-3 border">
                        <li class="flex justify-between py-5 bg-gray-100 hover:bg-gray-300 p-2 rounded-lg shadow-lg shadow-black/15">
                          <div class="flex min-w-0 gap-x-4 ml-3">
                            <div class="min-w-0 flex-auto">
                              <p class="text-lg/2 font-bold text-gray-900">Notifikasi baru</p>
                              <p class="mt-0.5 truncate text-sm text-gray-500">Selalu utamakan keselamatan saat bekerja</p>
                            </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm/6 text-gray-900">HRD</p>
                            <p class="mt-1 text-xs/5 text-gray-500">19 Dec 24 / 13:11</p>
                          </div>
                        </li>
                    </ul>
                </a>
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
            
            <div class="mb-2 bg-gray-200 rounded-md min-h-[200px] mr-1">
                <div class="flex justify-between">
                    <div class="p-2">
                        <span class="p-4 font-bold text-xl">Persyaratan KPI</span>
                    </div>
                    <div class="p-2">
                        <a href="/kpi-requirement/create-requirement">
                            <button class="bg-blue-500 rounded-md text-white p-1 font-medium">Upload</button>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button id="viewDocumentBtn" class="text-blue-500 hover:underline">View Document</button>
                </div>
            </div>
            <!-- Modal -->
            <div id="documentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-4 w-1/2">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold">Persyaratan KPI</h2>
                    <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <div class="mt-4">
                    <object id="pdfObject" data="" type="application/pdf" width="100%" height="600px"></object>
                </div>
            </div>
        </div>

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

    
    <script src="https://unpkg.com/pdfobject"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
  const departmentElement = document.getElementById('department');
  const filterNameElement = document.getElementById('filterName');
  const yearElement = document.getElementById('year');
  const semesterElement = document.getElementById('semester');

  function fetchData() {
    const department = departmentElement.value;
    const name = filterNameElement.value;
    const year = yearElement.value;
    const semester = semesterElement.value;

    // Update the URL with the current filter state
    const url = new URL(window.location);
    url.searchParams.set('department', department);
    url.searchParams.set('name', name);
    url.searchParams.set('year', year);
    url.searchParams.set('semester', semester);
    history.pushState(null, '', url);

    // Fetch data based on the filters
    fetch(`{{ url('dashboard/filter') }}?department=${department}&name=${name}&semester=${semester}&year=${year}`)
      .then(response => response.json())
      .then(data => {
        const tbody = document.getElementById('employeeTableBody');
        tbody.innerHTML = '';

        if (data.length > 0) {
          data.forEach((item, index) => { 
            const row = `<tr class="${index % 2 === 0 ? 'bg-blue-100' : 'bg-white'}">
              <td class="border-2 border-gray-400 tracking-wide px-2 py-0 text-center">${index + 1}</td>
              <td class="border-2 border-gray-400 tracking-wide px-2 py-0">
                <a href="/report/employee-report/${item.id}?semester=${semester}&year=${year}" class="hover:underline">${item.name}</a>
              </td>
              <td class="border-2 border-gray-400 tracking-wide px-2 py-0">${item.occupation}</td>
              <td class="border-2 border-gray-400 tracking-wide px-2 py-0">
                <a href="/target/input-target-kpi-department?department=${item.department_id}&year=${year}" class="hover:underline">${item.department}</a>
              </td>
            </tr>`;
            tbody.innerHTML += row;
          });
        } else {
          tbody.innerHTML = '<tr><td colspan="4" class="border-2 border-gray-400 tracking-wide px-2 py-0 text-center">No data found</td></tr>';
        }
      });
  }

  // Apply filters from the URL when the page loads
  const urlParams = new URLSearchParams(window.location.search);
  departmentElement.value = urlParams.get('department') || '';
  filterNameElement.value = urlParams.get('name') || '';
  yearElement.value = urlParams.get('year') || '';
  semesterElement.value = urlParams.get('semester') || '';

  fetchData();

  departmentElement.addEventListener('change', fetchData);
  filterNameElement.addEventListener('input', fetchData);
  yearElement.addEventListener('change', fetchData);
  semesterElement.addEventListener('change', fetchData);
});

document.getElementById('viewDocumentBtn').addEventListener('click', function() {
        document.getElementById('documentModal').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('documentModal').classList.add('hidden');
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('documentModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });

    document.getElementById('viewDocumentBtn').addEventListener('click', function() {
            fetch('/kpi-requirement/view-requirement')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const pdfUrl = data[0].file;
                        
                        document.getElementById('pdfObject').setAttribute('data', `/kpi_requirement_files/${pdfUrl}`);
                        document.getElementById('documentModal').classList.remove('hidden');
                    } else {
                        console.error('No PDF found');
                    }
                })
                .catch(error => console.error('Error fetching PDF URL:', error));
        });

        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('documentModal').classList.add('hidden');
        });

    </script>
</x-app-layout>