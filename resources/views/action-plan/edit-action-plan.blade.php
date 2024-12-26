<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <form action="{{ route('action-plan.updateFile', $employee->action_plan_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="grid grid-cols-2 gap-x-3">
            <div class="grid grid-cols-2 gap-x-3">
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">NIK</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="{{ $employee->nik }}" readonly>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Nama</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="{{ $employee->name }}" readonly>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Dept</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="{{ $employee->department }}" readonly>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Posisi</span>  
                    <input type="text" name="nik" id="nik" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="NIK" value="{{ $employee->occupation }}" readonly>
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Nama File</span>  
                    <input type="text" name="file_name" id="file_name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Nama file" autocomplete="off">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                </div>
                <div class="relative mt-1 rounded-md">
                    <span class="pl-3 font-semibold">Upload Action Plan</span>  
                  <input type="file" name="action_plan_file" id="action_plan_file" class=" block w-full rounded-md border-0 py-1.5 pl-1.5 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departemen">
                  <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->id }}">
                  <input type="hidden" name="department_id" id="department_id" value="{{ $employee->department_id }}">
                  <input type="hidden" value="{{ $employee->action_plan_id }}" name="action_plan_id" id="action_plan_id">
                  <div class="absolute inset-y-0 right-0 flex items-center">
                  </div>
                  <span class="pl-3 text-xs text-red-500">*</span>  
                  <span class="text-xs">Format .pdf</span>  
                </div>
                
                <div class="relative mt-1 rounded-md">
                    <div class="w-full rounded-md border-0 pr-20 text-gray-900  sm:text-sm sm:leading-6 mt-2 flex gap-x-6">
                      <div class="mb-2">
                        <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
                      </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                    </div>
                  </div>
                </div>
            </div>
            <div id="preview" class="mt-4"></div>
        </div>
    </form>
    </div>

    <script>
        document.getElementById('action_plan_file').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var preview = document.getElementById('preview');
            preview.innerHTML = '';

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var fileType = file.type;
                    var fileURL = e.target.result;

                    if (fileType.startsWith('image/')) {
                        var img = document.createElement('img');
                        img.src = fileURL;
                        img.className = 'w-full h-auto';
                        preview.appendChild(img);
                    } else if (fileType === 'application/pdf') {
                        var iframe = document.createElement('iframe');
                        iframe.src = fileURL;
                        iframe.className = 'w-full h-96';
                        preview.appendChild(iframe);
                    } else {
                        var p = document.createElement('p');
                        p.textContent = 'Pratinjau tidak tersedia untuk jenis file ini.';
                        preview.appendChild(p);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>