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
          <span class="text-red-500">*</span> 
          <select name="date" id="date" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            <option value="">-- Pilih Bulan --</option>
            <option value="01" data-target="{{ $target->target_unit_1 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_1 == 0 ? 'yes' : 'no' }}">January</option>
            <option value="02" data-target="{{ $target->target_unit_2 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_2 == 0 ? 'yes' : 'no' }}" >February</option>
            <option value="03" data-target="{{ $target->target_unit_3 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_3 == 0 ? 'yes' : 'no' }}">March</option>
            <option value="04" data-target="{{ $target->target_unit_4 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_4 == 0 ? 'yes' : 'no' }}">April</option>
            <option value="05" data-target="{{ $target->target_unit_5 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_5 == 0 ? 'yes' : 'no' }}">May</option>
            <option value="06" data-target="{{ $target->target_unit_6 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_6 == 0 ? 'yes' : 'no' }}">June</option>
            <option value="07" data-target="{{ $target->target_unit_7 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_7 == 0 ? 'yes' : 'no' }}">July</option>
            <option value="08" data-target="{{ $target->target_unit_8 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_8 == 0 ? 'yes' : 'no' }}">August</option>
            <option value="09" data-target="{{ $target->target_unit_9 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_9 == 0 ? 'yes' : 'no' }}">September</option>
            <option value="10" data-target="{{ $target->target_unit_10 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_10 == 0 ? 'yes' : 'no' }}">October</option>
            <option value="11" data-target="{{ $target->target_unit_11 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_11 == 0 ? 'yes' : 'no' }}">November</option>
            <option value="12" data-target="{{ $target->target_unit_12 ?? '' }}" data-unit="{{ $target->unit }}" data-zero="{{ $target->target_unit_12 == 0 ? 'yes' : 'no' }}">December</option>
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
            
          <input type="text" name="target" id="target" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Target" value="" readonly >
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-1 rounded-md">
            <span class="pl-3 font-semibold">Aktual</span>
            <span class="text-red-500">*</span>  
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
                <input type="hidden" name="input_by" id="input_by" value="Admin Kebun">
                <input type="hidden" name="status" id="status" value="Filled">
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
            const targetField = document.getElementById('target');
            const actualField = document.getElementById('actual');
            const achievementField = document.getElementById('achievement');
            const dateField = document.getElementById('date');
            const selectedOption = dateField.options[dateField.selectedIndex];
            const zeroValue = selectedOption.getAttribute('data-zero');
            const unitValue = selectedOption.getAttribute('data-unit');
    
            let target = parseFloat(targetField.value.replace('%', ''));
            let actual = parseFloat(actualField.value);
    
            if (zeroValue === 'yes' && unitValue == 'Freq') {
                if (actual == 0) {
                    achievementField.value = '100%';
                } else if (actual == 1) {
                    achievementField.value = '75%';
                } else if (actual == 2) {
                    achievementField.value = '50%';
                } else if (actual == 3) {
                    achievementField.value = '25%';
                } else if (actual == 4) {
                    achievementField.value = '10%';
                } else {
                    achievementField.value = '0%';
                }
            } else if (unitValue === 'Tgl') {
                if (target === 1) { // Target == 1
                    if (actual === target) {
                        achievementField.value = '100%';
                    } else if (actual === target + 1) {
                        achievementField.value = '75%';
                    } else if (actual === target + 2) {
                        achievementField.value = '50%';
                    } else {
                        achievementField.value = '0%';
                    }
                } else if (target === 2) { // target == 2
                    if (actual === target - 1) {
                      achievementField.value = '105%';
                    } else if (actual === target) {
                        achievementField.value = '100%';
                    } else if (actual === target + 1) {
                        achievementField.value = '90%';
                    } else if (actual === target + 2) {
                        achievementField.value = '80%';
                    } else {
                        achievementField.value = '0%';
                    }
                } else if (target === 3) { // Target == 3
                    if (actual === target - 2) {
                        achievementField.value = '110%';
                    } else if (actual === target - 1) {
                      achievementField.value = '105%';
                    } else if (actual === target) {
                        achievementField.value = '100%';
                    } else if (actual === target + 1) {
                        achievementField.value = '90%';
                    } else if (actual === target + 2) {
                        achievementField.value = '80%';
                    } else if (actual === target + 3) {
                        achievementField.value = '70%';
                    }
                    else {
                        achievementField.value = '0%';
                    }
                } else if (target === 4) { // Target == 4

                    if (actual === target - 3) {
                        achievementField.value = '115%';
                    } else if (actual === target - 2) {
                        achievementField.value = '110%';
                    } else if (actual === target - 1) {
                      achievementField.value = '105%';
                    } else if (actual === target) {
                        achievementField.value = '100%';
                    } else if (actual === target + 1) {
                        achievementField.value = '90%';
                    } else if (actual === target + 2) {
                        achievementField.value = '80%';
                    } else if (actual === target + 3) {
                        achievementField.value = '70%';
                    } else if (actual === target + 4) {
                        achievementField.value = '60%';
                    }
                    else {
                        achievementField.value = '0%';
                    }
                } else if (target === 4) { // Target == 4

                    if (actual === target - 3) {
                        achievementField.value = '115%';
                    } else if (actual === target - 2) {
                        achievementField.value = '110%';
                    } else if (actual === target - 1) {
                      achievementField.value = '105%';
                    } else if (actual === target) {
                        achievementField.value = '100%';
                    } else if (actual === target + 1) {
                        achievementField.value = '90%';
                    } else if (actual === target + 2) {
                        achievementField.value = '80%';
                    } else if (actual === target + 3) {
                        achievementField.value = '70%';
                    } else if (actual === target + 4) {
                        achievementField.value = '60%';
                    }
                    else {
                        achievementField.value = '0%';
                    }
                } else if (target === 5) { // Target == 5

                    if (actual === target - 4) {
                        achievementField.value = '120%';
                    } else if (actual === target - 3) {
                        achievementField.value = '115%';
                    } else if (actual === target - 2) {
                        achievementField.value = '110%';
                    } else if (actual === target - 1) {
                      achievementField.value = '105%';
                    } else if (actual === target) {
                        achievementField.value = '100%';
                    } else if (actual === target + 1) {
                        achievementField.value = '90%';
                    } else if (actual === target + 2) {
                        achievementField.value = '80%';
                    } else if (actual === target + 3) {
                        achievementField.value = '70%';
                    } else if (actual === target + 4) {
                        achievementField.value = '60%';
                    } else if (actual === target + 5) {
                        achievementField.value = '50%';
                    }
                    else {
                        achievementField.value = '0%';
                    }
                } else if (target === 6) { // Target == 6

                    if (actual === target - 5) {
                        achievementField.value = '125%';
                    } else if (actual === target - 4) {
                        achievementField.value = '120%';
                    } else if (actual === target - 3) {
                        achievementField.value = '115%';
                    } else if (actual === target - 2) {
                        achievementField.value = '110%';
                    } else if (actual === target - 1) {
                      achievementField.value = '105%';
                    } else if (actual === target) {
                        achievementField.value = '100%';
                    } else if (actual === target + 1) {
                        achievementField.value = '90%';
                    } else if (actual === target + 2) {
                        achievementField.value = '80%';
                    } else if (actual === target + 3) {
                        achievementField.value = '70%';
                    } else if (actual === target + 4) {
                        achievementField.value = '60%';
                    } else if (actual === target + 5) {
                        achievementField.value = '50%';
                    } else if (actual === target + 6) {
                        achievementField.value = '40%';
                    }
                    else {
                        achievementField.value = '0%';
                    }
                } 
            } else {
                if (!isNaN(target) && !isNaN(actual) && target !== 0) {
                    let achievement;
                    if (unitValue === 'Rp') {
                        achievement = (target / actual) * 100;
                    } else {
                        achievement = (actual / target) * 100;
                    }
                    achievementField.value = Math.round(achievement) + '%';
                } else {
                    achievementField.value = '';
                }
            }
        }
    
        document.getElementById('date').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var targetValue = selectedOption.getAttribute('data-target');
            var unitValue = selectedOption.getAttribute('data-unit');
            var targetField = document.getElementById('target');
    
            if (unitValue === '%') {
                targetValue = targetValue * 100;
                targetField.value = targetValue + '%';
            } else {
                targetField.value = targetValue;
            }
    
            calculateAchievement();
        });
    
        var actualInput = document.getElementById('actual');
        actualInput.addEventListener('input', function() {
            calculateAchievement();
        });
    
        document.getElementById('target').addEventListener('input', function() {
            calculateAchievement();
        });
    </script>

</x-app-layout>