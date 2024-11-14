<x-app-layout :title="$title" :desc="$desc">
  <form id="achievementForm" action="{{ url('actual/input-actual-achievement/store') }}" method="POST" enctype="multipart/form-data">
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
            <option value="01" data-target="{{ $target->target_unit_12 ?? '' }}">January</option>
            <option value="02" data-target="{{ $target->target_unit_1 ?? '' }}">February</option>
            <option value="03" data-target="{{ $target->target_unit_2 ?? '' }}">March</option>
            <option value="04" data-target="{{ $target->target_unit_3 ?? '' }}">April</option>
            <option value="05" data-target="{{ $target->target_unit_4 ?? '' }}">May</option>
            <option value="06" data-target="{{ $target->target_unit_5 ?? '' }}">June</option>
            <option value="07" data-target="{{ $target->target_unit_6 ?? '' }}">July</option>
            <option value="08" data-target="{{ $target->target_unit_7 ?? '' }}">August</option>
            <option value="09" data-target="{{ $target->target_unit_8 ?? '' }}">September</option>
            <option value="10" data-target="{{ $target->target_unit_9 ?? '' }}">October</option>
            <option value="11" data-target="{{ $target->target_unit_10 ?? '' }}">November</option>
            <option value="12" data-target="{{ $target->target_unit_11 ?? '' }}">December</option>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 items-center gap-x-2 gap-y-2" >
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
            <span class="pl-3 font-semibold">Trend</span>  
          <input type="text" name="trend" id="trend" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Bobot" value="{{ $target->trend }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-x-5">
          <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">Target</span> 
            
        @php
      $currentMonth = \Carbon\Carbon::now()->month;
      $targetUnit = '';

      switch ($currentMonth) {
          case 1:
              $targetUnit = $target->target_unit_12 ?? '';
              break;
          case 2:
              $targetUnit = $target->target_unit_1 ?? '';
              break;
          case 3:
              $targetUnit = $target->target_unit_2 ?? '';
              break;
          case 4:
              $targetUnit = $target->target_unit_3 ?? '';
              break;
          case 5:
              $targetUnit = $target->target_unit_4 ?? '';
              break;
          case 6:
              $targetUnit = $target->target_unit_5 ?? '';
              break;
          case 7:
              $targetUnit = $target->target_unit_6 ?? '';
              break;
          case 8:
              $targetUnit = $target->target_unit_7 ?? '';
              break;
          case 9:
              $targetUnit = $target->target_unit_8 ?? '';
              break;
          case 10:
              $targetUnit = $target->target_unit_9 ?? '';
              break;
          case 11:
              $targetUnit = $target->target_unit_10 ?? '';
              break;
          case 12:
              $targetUnit = $target->target_unit_11 ?? '';
              break;
          default:
              $targetUnit = '';
      }
        @endphp
          <input type="text" name="target" id="target" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Target" value="{{ $targetUnit }}" readonly >
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">Aktual</span>  
          <input type="text" name="actual" id="actual" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Aktual" oninput="calculateAchievement()" autocomplete="off">
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
              <textarea type="text" name="kpi_calculation" id="calculation" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Cara Menghitung" rows="2" readonly>{{ $target->calculation }}</textarea>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 items-center gap-x-6 gap-y-2" >
              </div>
              <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Keterangan</span>  
                <textarea name="detail" id="detail" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Keterangan" rows="2" readonly>{{ $target->detail }}</textarea>
                <input type="hidden" name="employee_id" id="employee_id" value="{{ $target->employee_id }}">
                <input type="hidden" name="pv_employee_id" id="pv_employee_id" value="{{ $target->employee_id }}">
                <input type="hidden" name="year" id="year" value="{{ $year = request()->query('year') }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
              <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Komentar</span>  
                <textarea name="comment" id="comment" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Komentar" rows="2"></textarea>
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
          <input type="file" name="record_file" id="record_file" class=" w-56 mx-20 rounded-md border-0 py-1.5 pl-1.5 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departemen">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-2 ">
        <div class="relative mt-1 rounded-md">
          <div class="w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900  sm:text-sm sm:leading-6 mt-2 flex gap-x-6">
            <div class="mb-2 mt-2">
              <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
            </div>
            <div class="mb-2 mt-2">
              <button type="submit" id="previewBtn" class="bg-green-500 text-white py-2 px-4 rounded-md">Preview</button>
          </div>
          <div class="p-2 mb-2 mt-2">
            <a href="#" class="p-4 bg-blue-500 py-2 items-center">
                <span class="font-medium text-white">Excel</span>
            </a>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
      </div>
    </form>
      @endforeach
  

    
    <script>

      document.getElementById('submitBtn').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('achievementForm').action = "{{ url('actual/input-actual-achievement/store') }}";
      document.getElementById('achievementForm').submit();
    });

      document.getElementById('previewBtn').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('achievementForm').action = "{{ url('actual/preview/store') }}";
      document.getElementById('achievementForm').submit();
    });
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

      document.getElementById('date').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var targetValue = selectedOption.getAttribute('data-target');
        document.getElementById('target').value = targetValue;
    });

    var actualInput = document.getElementById('actual');
    var unitInput = document.getElementById('kpi_unit');

    if (unitInput.value === '%') {
        actualInput.value = actualInput.value + '%';
    }

      </script>

</x-app-layout>