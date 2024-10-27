<x-app-layout :title="$title" :desc="$desc">
  <form id="formsub" name="formsub" action="{{ url('actual/input-actual-achievement/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="ml-64 mt-4 overflow-y-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
 
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-0">
      @foreach ($targets as $target)
        <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">NIK</span>  
            <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="{{ $target->nik }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        
        <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">Departemen</span>  
          <input type="text" name="department_name" id="department_name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departemen" value="{{ $target->department }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-1 rounded-md">
          <span class="pl-3 font-semibold">Bulan</span>
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
       
        <div class="relative mt-1 rounded-md">
          <span class="pl-3 font-semibold">Nama</span>  
        <input type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Nama" value="{{ $target->employee }}" readonly>
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      <div class="relative mt-1 rounded-md">
        <span class="pl-3 font-semibold">Posisi</span>  
      <input type="text" name="occupation" id="occupation" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Posisi" value="{{ $target->occupation }}" readonly>
      <div class="absolute inset-y-0 right-0 flex items-center">
      </div>
    </div>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-2">
        <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">No. KPI</span>  
          <input type="text" name="kpi_code" id="kpi_code" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="No. KPI" value="{{ $target->code }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
      </div>
      
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 items-center gap-x-6 gap-y-2" >
            <div class="relative mt-1 rounded-md">
              <span class="pl-3 font-semibold">Item KPI</span>  
              <textarea name="kpi_item" id="kpi_item" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Item KPI" rows="2" readonly>{{ $target->indicator }}</textarea>
            <div class="absolute inset-y-0 right-0 flex items-center">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center gap-x-6 gap-y-2" >
              <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Periode Review</span>  
              <input type="text" name="review_period" id="review_period" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Periode Review" value="{{ $target->period }}" readonly>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
              <span class="pl-3 font-semibold">Satuan</span>  
            <input type="text" name="kpi_unit" id="kpi_unit" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Satuan" value="{{ $target->unit }}" readonly>
            <div class="absolute inset-y-0 right-0 flex items-center">
            </div>
          </div>
          <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">Bobot</span>  
          <input type="text" name="kpi_weighting" id="kpi_weighting" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Bobot" value="{{ $target->weighting }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-1 rounded-md">
          <span class="pl-3 font-semibold">Target</span>  
        <input type="text" name="target" id="target" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Target" value="{{ $target->target_unit_4 }}" readonly >
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      <div class="relative mt-1 rounded-md">
          <span class="pl-3 font-semibold">Aktual</span>  
        <input type="text" name="actual" id="actual" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Aktual" oninput="calculateAchievement()">
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      <div class="relative mt-1 rounded-md">
          <span class="pl-3 font-semibold">"%" Pencapaian</span>  
        <input type="text" name="achievement" id="achievement" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Pencapaian" readonly>
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
            </div>
            </div>
            <div class="relative mt-1 rounded-md">
              <span class="pl-3 font-semibold">Cara Menghitung</span>  
              <input type="text" name="kpi_calculation" id="calculation" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Cara Menghitung" value="{{ $target->calculation }}"readonly>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 items-center gap-x-6 gap-y-2" >
                <div class="relative mt-1 rounded-md">
                  <span class="pl-3 font-semibold">Nama Program</span>  
                <input type="text" name="program_number" id="program_number" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Nama Program">
                <div class="absolute inset-y-0 right-0 flex items-center">
                </div>
              </div>
              <div class="relative mt-1 rounded-md">
                  <span class="pl-3 font-semibold">Upload File Program</span>  
                <input type="file" name="program_file" id="program_file" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Posisi">
                <div class="absolute inset-y-0 right-0 flex items-center">
                </div>
              </div>
              </div>
              <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Komentar</span>  
                <textarea name="comment" id="comment" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Komentar" rows="2"></textarea>
                <input type="hidden" name="employee_id" id="employee_id" value="{{ $target->employee_id }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
          </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-2 ">
        <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">Nama Rekaman Data Pendukung</span>  
          <input type="text" name="supporting_document" id="supporting_document" class="block w-96 rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Nama Rekaman" value="{{ $target->supporting_document }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-1 rounded-md">
            <span class="mx-20 font-semibold">Upload Rekaman</span>  
          <input type="file" name="record_file" id="record_file" class=" w-24 mx-20 rounded-md border-0 py-1.5 pl-1.5 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departemen">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-2 ">
        <div class="relative mt-1 rounded-md">
          <div class="w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900  sm:text-sm sm:leading-6 mt-2 flex gap-x-6">
            <div class="mb-2 mt-2">
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md" form="formsub">Submit</button>
            </div>
          </form>
            <form id="formprev" name="formprev" action="{{ url('actual/preview/store') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="mb-2 mt-2">
              <input type="hidden" name="pv_kpi_code" id="pv_kpi_code" value="{{ $target->code }}">
              <input type="hidden" name="pv_nik" id="pv_nik" value="{{ $target->nik }}">
              <input type="hidden" name="pv_employee" id="pv_employee" value="{{ $target->employee }}">
              <input type="hidden" name="pv_kpi_calculation" id="pv_kpi_calculation" value="{{ $target->calculation }}">
              <input type="hidden" name="pv_indicator" id="pv_indicator" value="{{ $target->indicator }}">
              <input type="hidden" name="pv_occupation" id="pv_occupation" value="{{ $target->occupation }}">
              <input type="hidden" name="pv_review_period" id="pv_period" value="{{ $target->period }}">
              <input type="hidden" name="pv_unit" id="pv_unit" value="{{ $target->unit }}">
              <input type="hidden" name="pv_kpi_weighting" id="pv_kpi_weighting" value="{{ $target->weighting }}">
              <input type="hidden" name="employee_id" id="employee_id" value="{{ $target->employee_id }}">
              <input type="hidden" name="pv_target" id="pv_target" value="{{ $target->target_unit_4 }}">
              <input type="hidden" name="pv_kpi_item" id="pv_kpi_item" value="{{ $target->indicator }}">
              <input type="hidden" name="pv_department_name" id="pv_department_name" value="{{ $target->department }}">
              <input type="hidden" name="pv_employee_id" id="pv_employee_id" value="{{ $target->department }}">
              <input type="hidden" name="pv_date" id="pv_date" value="">
              <input type="hidden" name="pv_actual" id="pv_actual" value="">
              <input type="hidden" name="pv_achievement" id="pv_achievement" value="">
              <input type="hidden" name="pv_record_file" id="pv_record_file" value="">
              <input type="hidden" name="pv_supporting_document" id="pv_supporting_document" value="">
              <input type="hidden" name="pv_program_number" id="pv_program_number" value="">
              <input type="hidden" name="pv_program_file" id="pv_program_file" value="">
              <input type="hidden" name="pv_comment" id="pv_comment" value="">
              <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md" form="formprev" onclick="fillHiddenInputs()">Preview</button>
          </div>
        </form>
          
          <div class="p-2 mb-2 mt-2">
            <a href="#" class="p-4 bg-blue-500 py-2 items-center">
                <span class="font-medium text-white">Excel</span>
            </a>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
      </div>
      @endforeach
  

    
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

      function fillHiddenInputs() {
      document.getElementById('pv_kpi_code').value = document.getElementById('kpi_code').value;
      document.getElementById('pv_kpi_item').value = document.getElementById('kpi_item').value;
      document.getElementById('pv_target').value = document.getElementById('target').value;
      document.getElementById('pv_date').value = document.getElementById('date').value;
      document.getElementById('pv_actual').value = document.getElementById('actual').value;
      document.getElementById('pv_achievement').value = document.getElementById('achievement').value;
      document.getElementById('pv_record_file').value = document.getElementById('record_file').value;
      document.getElementById('pv_supporting_document').value = document.getElementById('supporting_document').value;
      document.getElementById('pv_program_number').value = document.getElementById('program_number').value;
      document.getElementById('pv_program_file').value = document.getElementById('program_file').value;
      document.getElementById('pv_comment').value = document.getElementById('comment').value;
      document.getElementById('pv_employee_id').value = document.getElementById('employee_id').value;
    }
      </script>

</x-app-layout>