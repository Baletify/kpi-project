<x-app-layout :title="$title" :desc="$desc">
  <form action="{{ url('actual/input-actual-achievement/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="ml-64 mt-4 overflow-y-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
 
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-2">
      @foreach ($targets as $target)
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">NIK</span>  
            <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="NIK" value="{{ $target->nik }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Departemen</span>  
          <input type="text" name="department_name" id="department_name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Departemen" value="{{ $target->department }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
      
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Nama</span>  
          <input type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Nama" value="{{ $target->employee }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Posisi</span>  
          <input type="text" name="occupation" id="occupation" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Posisi" value="{{ $target->occupation }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
        <select name="date" id="date" class="block w-full">
            <option value="">-- Pilih Bulan --</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-2">
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">No. KPI</span>  
          <input type="text" name="kpi_code" id="kpi_code" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="No. KPI" value="{{ $target->code }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Cara Menghitung</span>  
          <input type="text" name="kpi_calculation" id="calculation" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Cara Menghitung" value="{{ $target->calculation }}"readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Item KPI</span>  
            <textarea name="kpi_item" id="kpi_item" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Item KPI" rows="4" readonly>{{ $target->indicator }}</textarea>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-2" >
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Periode Review</span>  
          <input type="text" name="review_period" id="review_period" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Periode Review" value="{{ $target->period }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Satuan</span>  
          <input type="text" name="kpi_unit" id="kpi_unit" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Satuan" value="{{ $target->unit }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Bobot</span>  
          <input type="text" name="kpi_weighting" id="kpi_weighting" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Bobot" value="{{ $target->weighting }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
          <span class="pl-3">Target</span>  
        <input type="text" name="target" id="target" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Target" value="{{ $target->target_unit_4 }}" readonly >
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      <div class="relative mt-2 rounded-md shadow-sm">
          <span class="pl-3">Aktual</span>  
        <input type="text" name="actual" id="actual" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Aktual" oninput="calculateAchievement()">
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      <div class="relative mt-2 rounded-md shadow-sm">
          <span class="pl-3">"%" Pencapaian</span>  
        <input type="text" name="achievement" id="achievement" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Pencapaian" readonly>
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-2 ">
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Nama Rekaman Data Pendukung</span>  
          <input type="text" name="record_name" id="record_name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Nama Rekaman">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Upload Rekaman</span>  
          <input type="file" name="record_file" id="record_file" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Departemen">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Nama Program</span>  
          <input type="text" name="program_number" id="program_number" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Nama Program">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Upload File Program</span>  
          <input type="file" name="program_file" id="program_file" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Posisi">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
          <span class="pl-3">Komentar</span>  
          <textarea name="comment" id="comment" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Komentar" rows="4"></textarea>
          <input type="hidden" name="employee_id" id="employee_id" value="{{ $target->employee_id }}">
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
    
      @endforeach
    
       <div class="relative mt-2 rounded-md shadow-sm">
        <div class="w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900  sm:text-sm sm:leading-6 mt-2 flex gap-x-6">
          <div class="p-2 mb-2 mt-2">
            <a href="#" class="p-4 bg-blue-500 py-2 items-center">
                <span class="font-medium text-white">Preview</span>
            </a>
        </div>
        <div class="mb-2 mt-2">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
        </div>
        <div class="p-2 mb-2 mt-2">
          <a href="#" class="p-4 bg-blue-500 py-2 items-center">
              <span class="font-medium text-white">Excel</span>
          </a>
        </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      </div>
    </div>
  </form>
    <script>
      function calculateAchievement() {
          const target = parseFloat(document.getElementById('target').value);
          const actual = parseFloat(document.getElementById('actual').value);
          const achievementField = document.getElementById('achievement');
      
          if (!isNaN(target) && !isNaN(actual) && actual !== 0) {
              const achievement = (actual / target) * 100;
              achievementField.value = Math.round(achievement) + '%';
          } else {
              achievementField.value = '';
          }
      }
      </script>        
</x-app-layout>