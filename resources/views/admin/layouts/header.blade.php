<header class="sticky top-0 w-full bg-white/80 backdrop-blur-md z-40 border-b border-gray-200/60 shadow-sm">
    <nav class="flex items-center justify-between px-4 lg:px-6 py-3" aria-label="Global">
        <!-- Left Side -->
        <div class="flex items-center gap-4">
            <!-- Mobile Menu Toggle -->
            <button type="button" onclick="openSidebarAdminDashboard()"
                class="xl:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                <i class="ti ti-menu-2 text-xl text-gray-600"></i>
            </button>
        </div>

        <!-- Right Side - User Profile -->
        <div class="flex items-center gap-3" data-dropdown-toggle
            onclick="toggleDropdownAdminDashboard('profile-dropdown')">
            <div class="hidden sm:block text-right">
                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                <span
                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                    {{ Auth::user()->roles->first()->name }}
                </span>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <img class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-100"
                    src="{{ asset('assets/images/logo.jpeg') }}" alt="User avatar">

                <div id="profile-dropdown" data-dropdown-menu
                    class="absolute right-0 top-full mt-2 w-[200px] bg-white shadow-xl rounded-xl border border-gray-100 py-2 hidden opacity-0 transition-opacity duration-200 z-50">
                    <div class="px-4 py-3 border-b border-gray-100 sm:hidden">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 mt-1">
                            {{ Auth::user()->roles->first()->name }}
                        </span>
                    </div>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 transition-colors duration-200 text-gray-700">
                        <i class="ti ti-user text-lg text-gray-400"></i>
                        <span class="text-sm font-medium">My Profile</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 transition-colors duration-200 text-gray-700">
                        <i class="ti ti-settings text-lg text-gray-400"></i>
                        <span class="text-sm font-medium">Settings</span>
                    </a>
                    <div class="border-t border-gray-100 my-2"></div>
                    <div class="px-4 py-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200">
                                <i class="ti ti-logout text-lg"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
