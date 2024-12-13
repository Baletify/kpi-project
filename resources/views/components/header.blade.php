<header class="w-full bg-gray-50">
    <div class="py-6 px-6 bg-[#3572EF] flex items-center shadow-md shadow-black/5">
        {{-- <button class="text-lg text-gray-600">
            <i class="ri-menu-line text-lg"></i>
        </button> --}}
        <ul class="flex items-center text-sm ml-64">
            <li class="mr-2">
                <a href="#" class="text-white hover:text-gray-600 text-xl">{{ $title }}</a>
            </li>
            <li class="text-white mr-2 text-lg"> / </li>
            <li class="text-white mr-2 text-xl"> {{ $desc }} </li>
        </ul>
        <ul class="ml-auto flex items-center">
            <li class="mr-1">
                <a href="#" class="text-white hover:text-red-600 font-bold">Logout</a>
            </li>
        </ul>
    </div>
    <div class="px-6 flex-2">
        {{ $slot }}
    </div>
</header>
