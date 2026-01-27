<nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-4 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex justify-between items-center h-12">

            <div class="shrink-0 flex items-center gap-2 cursor-pointer">
                <img src="{{ asset('assets/images/logo-nobg.png') }}" alt="logo" class="w-28">
            </div>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-gray-800 hover:text-primary font-medium transition">Home</a>

                <div class="relative group">
                    <button
                        class="text-gray-800 hover:text-primary font-medium transition flex items-center gap-1 focus:outline-none">
                        Destinasi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl border-t-4 border-primary opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left">
                        <div class="py-1">
                            <a href="{{ route('dam-cokro-resto') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Dam
                                Cokro Resto</a>
                            <a href="{{ route('pavilion') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Pendopo</a>
                            <a href="{{ route('pool') }}"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Kolam
                                Renang</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('about') }}"
                    class="text-gray-800 hover:text-primary font-medium transition">Tentang</a>
                <a href="{{ route('contact') }}"
                    class="text-gray-800 hover:text-primary font-medium transition">Kontak</a>
            </div>

            <div class="hidden md:flex">
                <a href="{{ route('reservation') }}"
                    class="bg-primary hover:bg-green-800 text-white px-6 py-2 rounded-full font-medium transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Reservasi
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-gray-800 hover:text-primary focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- mobile navbar --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg absolute w-full left-0 top-full border-t">
        <div class="px-4 pt-2 pb-4 space-y-2">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-green-50 hover:text-primary">Home</a>
            <div class="pl-3 space-y-1 border-l-2 border-gray-100 ml-3">
                <p class="px-3 py-1 text-xs text-gray-400 font-semibold uppercase">Destinasi</p>
                <a href="{{ route('dam-cokro-resto') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary">Dam
                    Cokro Resto</a>
                <a href="{{ route('pavilion') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary">Pendopo</a>
                <a href="{{ route('pool') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary">Kolam Renang</a>
            </div>
            <a href="{{ route('about') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-green-50 hover:text-primary">Tentang</a>
            
            <a href="{{ route('contact') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-green-50 hover:text-primary">Kontak</a>
            
            <a href="{{ route('reservation') }}"
                class="block w-full text-center mt-4 bg-primary text-white px-4 py-3 rounded-lg font-bold">Reservasi
                Sekarang</a>
        </div>
    </div>
</nav>
