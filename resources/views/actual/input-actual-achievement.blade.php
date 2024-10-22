<x-app-layout :title="$title" :desc="$desc">
  <div class="ml-64 mt-4 overflow-y-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-2 ">
      @foreach ($targets as $target)
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">NIK</span>  
            <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="NIK" value="{{ $target->nik }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Departemen</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Departemen" value="{{ $target->department }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
      
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Nama</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Nama" value="{{ $target->employee }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Posisi</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Posisi" value="{{ $target->occupation }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
          <span class="pl-3">Bulan</span>  
        <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Bulan">
        <div class="absolute inset-y-0 right-0 flex items-center">
        </div>
      </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-2">
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">No. KPI</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="No. KPI" value="{{ $target->code }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Cara Menghitung</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Cara Menghitung" value="{{ $target->calculation }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Item KPI</span>  
            <textarea name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Item KPI" rows="4" readonly>{{ $target->indicator }}</textarea>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-2 ">
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Periode Review</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Periode Review" value="{{ $target->period }}" >
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Satuan</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Satuan" value="{{ $target->unit }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Bobot</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Bobot" value="{{ $target->weighting }}" readonly>
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
          <span class="pl-3">Target</span>  
        <input type="text" name="target" id="target" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Target" value="{{ $target->target_unit_4 }}" >
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
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Nama Rekaman">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Upload Rekaman</span>  
          <input type="file" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Departemen">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Nama Program</span>  
          <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Nama Program">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <span class="pl-3">Upload File Program</span>  
          <input type="file" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Posisi">
          <div class="absolute inset-y-0 right-0 flex items-center">
          </div>
        </div>
        <div class="relative mt-2 rounded-md shadow-sm">
          <span class="pl-3">Komentar</span>  
          <textarea name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-2" placeholder="Komentar" rows="4"></textarea>
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
        <div class="p-2 mb-2 mt-2">
          <a href="#" class="p-4 bg-blue-500 py-2 items-center">
              <span class="font-medium text-white">Submit</span>
          </a>
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