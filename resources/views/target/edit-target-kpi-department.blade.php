<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
      @php
        $semesterQuery = request()->query('semester');
      @endphp
        <form action="{{ route('target.updateDept') }}" method="POST">
            @csrf
            @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-4 gap-y-0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-4 gap-y-0">
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Kode KPI</span>  
                <input type="text" name="code" id="code" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Kode KPI" value="{{ $target->code }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">KPI</span>  
                <textarea name="indicator" id="indicator" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Item KPI" rows="2">{{ $target->indicator }}</textarea>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
        </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Cara Menghitung</span>  
                <textarea name="calculation" id="calculation" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Item KPI" rows="2">{{ $target->calculation }}</textarea>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-0">
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Unit</span>  
                    <input type="text" name="unit" id="unit" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Unit" value="{{ $target->unit }}">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Periode Review</span>  
                    <input type="text" name="period" id="period" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Periode Review" value="{{ $target->period }}">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Bobot</span>  
                    <input type="text" name="weighting" id="weighting" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Bobot" value="{{ $target->weighting }}">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Trend</span>  
                    <input type="text" name="trend" id="trend" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Trend" value="{{ $target->trend }}">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                  <span class="pl-3 font-semibold">Status</span>  
                  <select name="is_active" id="is_active" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pl-3 pr-7 text-base text-gray-500 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option value="{{ $target->is_active }}">{{ $target->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center">
                </div>
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Cara Menghitung</span>  
                <textarea name="supporting_document" id="supporting_document" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Item KPI" rows="2">{{ $target->supporting_document }}</textarea>
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
        </div>
        <span class=" font-bold text-[18px]">Target KPI</span>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-x-4 gap-y-0">
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Jan</span>  
                <input type="text" name="target_1" id="target_1" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Jan" value="{{ $target->target_1 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Feb</span>  
                <input type="text" name="target_2" id="target_2" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Feb" value="{{ $target->target_2 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Mar</span>  
                <input type="text" name="target_3" id="target_3" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Mar" value="{{ $target->target_3 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Apr</span>  
                <input type="text" name="target_4" id="target_4" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Apr" value="{{ $target->target_4 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">May</span>  
                <input type="text" name="target_5" id="target_5" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="May" value="{{ $target->target_5 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Jun</span>  
                <input type="text" name="target_6" id="target_6" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Jun" value="{{ $target->target_6 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Jul</span>  
                <input type="text" name="target_7" id="target_7" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Jul" value="{{ $target->target_7 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Aug</span>  
                <input type="text" name="target_8" id="target_8" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Aug" value="{{ $target->target_8 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Sep</span>  
                <input type="text" name="target_9" id="target_9" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Sep" value="{{ $target->target_9 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Oct</span>  
                <input type="text" name="target_10" id="target_10" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Oct" value="{{ $target->target_10 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Nov</span>  
                <input type="text" name="target_11" id="target_11" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Nov" value="{{ $target->target_11 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
            </div>
            <div class="relative mt-1 rounded-md">
                <span class="pl-3 font-semibold">Dec</span>  
                <input type="text" name="target_12" id="target_12" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Dec" value="{{ $target->target_12 }}">
              <div class="absolute inset-y-0 right-0 flex items-center">
              </div>
              <input type="hidden" name="department_id" id="department_id" value="{{ $target->department_id }}">
              <input type="hidden" name="department_target_id" id="department_target_id" value="{{ $target->department_target_id }}">
              <input type="hidden" name="year" id="year" value="{{ $target->year }}">
              <input type="hidden" name="semester" id="semester" value="{{ $semesterQuery }}">
              <input type="hidden" name="target_unit_id" id="target_unit_id" value="{{ $target->target_unit_id }}">
            </div>
        </div>
        <div class="flex justify-center mt-4 gap-3">
          <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-md" onclick="history.back()">Cancel</button>
            <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
        </div>
    </form>
    </div>
</x-app-layout>