<header class="w-full bg-gray-50">
    <div class="py-6 px-6 bg-gradient-to-bl from-[#3572EF] to-[#050C9C] flex items-center shadow-md shadow-black/5">
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
            <div class="p-0">
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="text-white font-bold hover:underline" type="submit">Logout</button>
                </form>
            </div>
        </ul>
    </div>
    <div class="px-6 flex-2">
        {{ $slot }}
    </div>
</header>
