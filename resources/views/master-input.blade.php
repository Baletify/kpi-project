<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md border-collapse">
        <table class="w-full table-fixed">
            <tr class="bg-blue-700">
                <th style="width: 4%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">No.</th>
                <th style="width: 10%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Dept</th>
                <th style="width: 10%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">PIC Input</th>
                <th style="width: 22%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Check 1</th>
                <th style="width: 22%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Check 2</th>
                <th style="width: 22%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Approved</th>
                <th style="width: 10%" class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4">Final Check</th>
            </tr>
            @php
            $i = 0;
            @endphp
            @foreach ($departments as $department)
                @php
                $i++;
                $individual = $individuals->first(function ($item) use ($department) {
                    return $item->id == $department->id;
                });
                

                @endphp
            <tr class="{{ $i % 2 == 0 ?  'bg-white' : 'bg-blue-100' }}">
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 text-center py-0 px-4">{{ $i }}</td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">{{ $department->name }}</td>

                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">
                    {{ ($individual->name ?? '') ? 'Input Mandiri' : 'Clerk & Opas' }}
                </td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4 group">
                    {{ $department->check_1 ?? '-' }}
                    <button type="button" class="bg-yellow-500 invisible group-hover:visible mx-4 my-0.5 px-2 rounded-sm" onclick="openModal('check1Modal-{{ $i }}')">
                        <i class="ri-edit-line"></i>
                    </button>
                </td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4 group">
                    {{ $department->check_2 ?? '-' }}
                    <button type="button" class="bg-yellow-500 invisible group-hover:visible mx-4 my-0.5 px-2 rounded-sm" onclick="openModal('check2Modal-{{ $i }}')">
                        <i class="ri-edit-line"></i>
                    </button>
                </td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4 group">
                    {{ $department->mng_approve ?? '-' }}
                    <button type="button" class="bg-yellow-500 invisible group-hover:visible mx-4 my-0.5 px-2 rounded-sm"  onclick="openModal('check3Modal-{{ $i }}')">
                        <i class="ri-edit-line"></i>
                    </button>
                </td>
                <td class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-gray-700 py-0 px-4">HRD Spv</td>
            </tr>
            {{-- Check 1 Modal starts --}}
            <div id="check1Modal-{{ $i }}" class="fixed flex inset-0 bg-gray-600 bg-opacity-50 items-center justify-center hidden">
                <div class="bg-white rounded-lg p-4 w-[450px]">
                    <div class="flex justify-end">
                        <button type="button"onclick="closeModal('check1Modal-{{ $i }}')">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                    <div class="flex justify-center mb-5">
                        <h1 class="font-bold text-[20px] text-gray-800">Update data Check 1</h1>
                    </div>
                    <form action="{{ route('updateMasterInput') }}" method="POST">
                        @csrf
                        <div class="flex flex-col h-[400px] w-full">
                            <div class="">
                                <span class="font-semibold">Departemen</span>  
                                <input type="text" name="department_name" id="department_name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departemen" value="{{ $department->name }}" readonly>
                            </div>
                            <div class="">
                                <span class="font-semibold">Email Lama</span>  
                                <input type="text" name="old_email" id="old_email" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Email Lama" value="{{ $department->check_1 }}" readonly>
                            </div>
                            <div class="">
                                <span class="font-semibold">Email Baru</span>  
                                <input type="text" name="new_email" id="new_email" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Masukkan email baru" required>
                            </div>
                            <input type="hidden" name="department_id" id="department_id" value="{{ $department->id }}">
                            <input type="hidden" name="new_role" id="new_role" value="Checker 1">
                            <input type="hidden" name="column" id="column" value="check_1">
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Check 1 Modal ends --}}

            {{-- Check 2 Modal starts --}}
            <div id="check2Modal-{{ $i }}" class="fixed flex inset-0 bg-gray-600 bg-opacity-50 items-center justify-center hidden">
                <div class="bg-white rounded-lg p-4 w-[450px]">
                    <div class="flex justify-end">
                        <button type="button"onclick="closeModal('check2Modal-{{ $i }}')">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                    <div class="flex justify-center mb-5">
                        <h1 class="font-bold text-[20px] text-gray-800">Update data Check 2</h1>
                    </div>
                    <form action="{{ route('updateMasterInput') }}" method="POST">
                        @csrf
                        <div class="flex flex-col h-[400px] w-full">
                            <div class="">
                                <span class="font-semibold">Departemen</span>  
                                <input type="text" name="department_name" id="department_name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departemen" value="{{ $department->name }}" readonly>
                            </div>
                            <div class="">
                                <span class="font-semibold">Email Lama</span>  
                                <input type="text" name="old_email" id="old_email" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Email Lama" value="{{ $department->check_2 }}" readonly>
                            </div>
                            <div class="">
                                <span class="font-semibold">Email Baru</span>  
                                <input type="text" name="new_email" id="new_email" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Masukkan email baru" required>
                            </div>
                            <input type="hidden" name="department_id" id="department_id" value="{{ $department->id }}">
                            <input type="hidden" name="new_role" id="new_role" value="Checker 2">
                            <input type="hidden" name="column" id="column" value="check_2">
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Check 2 Modal ends --}}

            {{-- Check 3 Modal starts --}}
            <div id="check3Modal-{{ $i }}" class="fixed flex inset-0 bg-gray-600 bg-opacity-50 items-center justify-center hidden">
                <div class="bg-white rounded-lg p-4 w-[450px]">
                    <div class="flex justify-end">
                        <button type="button"onclick="closeModal('check3Modal-{{ $i }}')">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                    <form action="{{ route('updateMasterInput') }}" method="POST">
                        @csrf
                    <div class="flex justify-center mb-5">
                        <h1 class="font-bold text-[20px] text-gray-800">Update data Check 3</h1>
                    </div>
                        <div class="flex flex-col h-[400px] w-full">
                            <div class="">
                                <span class="font-semibold">Departemen</span>  
                                <input type="text" name="department_name" id="department_name" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Departemen" value="{{ $department->name }}" readonly>
                            </div>
                            <div class="">
                                <span class="font-semibold">Email Lama</span>  
                                <input type="text" name="old_email" id="old_email" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Email Lama" value="{{ $department->mng_approve }}" readonly>
                            </div>
                            <div class="">
                                <span class="font-semibold">Email Baru</span>  
                                <input type="text" name="new_email" id="new_email" class="block w-full rounded-md border-0 py-1.5 pl-4 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 mt-1" placeholder="Masukkan email baru" required>
                            </div>
                            <input type="hidden" name="department_id" id="department_id" value="{{ $department->id }}">
                            <input type="hidden" name="new_role" id="new_role" value="Mng Approver">
                            <input type="hidden" name="column" id="column" value="mng_approve">
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Check 3 Modal ends --}}
            @endforeach
        </table>
        
    </div>
</x-app-layout>


<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>