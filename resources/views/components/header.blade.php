<header class="w-full bg-gray-50">
    <div class="py-0.5 bg-gradient-to-bl from-[#3572EF] to-[#090F79] flex justify-center items-center shadow-md shadow-black/5">
        <div class="flex flex-col justify-center items-center">
            <div class="ml-64">
                <p class="font-bold text-white text-xl">APLIKASI KPI (Key Performa Indicator)</p>
            </div>
            <div class="ml-64">
                <p class="font-semibold text-white text-lg">PT BRIDGESTONE KALIMANTAN PLANTATION</p>
            </div>
        </div>
    </div>
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
            <div class="mr-6 flex justify-between">
                <div class="">
                    <i class="ri-user-3-fill text-white"></i>
                </div>
                <div class="mx-2">
                    <span class="text-white font-semibold">{{ auth()->user()->name }}</span>
                </div>
            </div>
            <div class="p-0">
                <form method="POST" action="{{ route('auth.logout') }}" onsubmit="clearLocalStorage()">
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

<script>
    function clearLocalStorage() {
        localStorage.clear();
    }
</script>
