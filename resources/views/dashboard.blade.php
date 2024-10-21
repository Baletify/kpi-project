<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 px-2">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-md border border-gray-200 p-6 mt-2">
                <div class="flex justify-between">
                    <div>
                        <div class="text-2xl font-semibold mb-1">140</div>
                        <div class="text-sm font-medium text-gray-500">Total Karyawan</div>
                    </div>
                    <i class="ri-group-fill text-5xl"></i>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-200 p-6 mt-2">
                <div class="flex justify-between">
                    <div>
                        <div class="text-2xl font-semibold mb-1">11</div>
                        <div class="text-sm font-medium text-gray-500">Total Divisi</div>
                    </div>
                    <i class="ri-team-fill text-5xl"></i>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-200 p-6 mt-2">
                <div class="flex justify-between">
                    <div>
                        <div class="text-2xl font-semibold mb-1">4</div>
                        <div class="text-sm font-medium text-gray-500">Total Semester</div>
                    </div>
                    <i class="ri-bar-chart-2-fill text-5xl"></i>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>