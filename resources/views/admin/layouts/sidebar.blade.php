<aside id="application-sidebar-brand"
    class="fixed top-0 start-0 h-screen z-[60] w-[270px] bg-white border-r border-gray-200 shadow-lg transform -translate-x-full xl:translate-x-0 transition-transform duration-300 ease-in-out">

    <!-- Close button for mobile -->
    <div class="absolute top-3 end-3 xl:hidden">
        <button type="button" onclick="closeSidebarAdminDashboard()"
            class="w-8 h-8 inline-flex justify-center items-center rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors">
            <span class="sr-only">Close</span>
            <i class="ti ti-x text-lg"></i>
        </button>
    </div>

    <!-- Logo Section -->
    <div class="p-5 border-b border-gray-100">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                <i class="ti ti-dashboard text-white text-xl"></i>
            </div>
            <div>
                <h2 class="font-bold text-lg text-gray-800">DASHBOARD</h2>
                <span class="text-xs text-gray-500">Admin Panel</span>
            </div>
        </a>
    </div>

    <!-- Scrollable Navigation -->
    <div class="h-[calc(100vh-100px)] overflow-y-auto px-4 py-6">
        <nav class="w-full flex flex-col">
            <ul id="sidebarnav" class="text-gray-700 text-sm space-y-1">

                {{-- HOME --}}
                <li class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pb-2">
                    <span>HOME</span>
                </li>

                <li>
                    <a class="flex items-center gap-3 py-2.5 px-3 rounded-lg w-full transition-all duration-200 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('admin.dashboard') ? 'bg-green-500 text-white shadow-md shadow-green-500/30' : 'text-gray-600' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="ti ti-layout-dashboard text-xl"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>

                {{-- MAIN --}}
                <li class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pb-2 pt-6">
                    <span>MAIN</span>
                </li>

                <!-- Courses Accordion -->
                @php
                    $isCoursesActive = request()->routeIs('categories.*') || request()->routeIs('courses.*');
                @endphp
                <li>
                    <button type="button" data-accordion-toggle="courses-accordion-content"
                        class="flex items-center justify-between w-full py-2.5 px-3 rounded-lg transition-all duration-200 cursor-pointer {{ $isCoursesActive ? 'bg-green-50 text-green-600' : 'text-gray-600 hover:bg-green-50 hover:text-green-600' }}">
                        <span class="flex items-center gap-3">
                            <i class="ti ti-book text-xl"></i>
                            <span class="font-medium">Courses</span>
                        </span>
                        <i
                            class="ti ti-chevron-down text-sm transition-transform duration-200 accordion-icon {{ $isCoursesActive ? 'rotate-180' : '' }}"></i>
                    </button>

                    <div id="courses-accordion-content"
                        class="w-full overflow-hidden transition-all duration-300 {{ $isCoursesActive ? '' : 'hidden' }}">
                        <ul class="mt-1 ml-4 pl-4 border-l-2 border-gray-200 space-y-1">
                            <li>
                                <a class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm transition-all duration-200 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('categories.*') ? 'text-green-600 bg-green-50 font-medium' : 'text-gray-500' }}"
                                    href="#">
                                    <i class="ti ti-point text-xs"></i>
                                    <span>Category</span>
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm transition-all duration-200 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('courses.*') ? 'text-green-600 bg-green-50 font-medium' : 'text-gray-500' }}"
                                    href="#">
                                    <i class="ti ti-point text-xs"></i>
                                    <span>Course List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- CMS --}}
                <li class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pb-2 pt-6">
                    <span>CMS</span>
                </li>
                @php
                    $isCoursesActive = request()->routeIs('categories.*') || request()->routeIs('courses.*');
                @endphp
                <li>
                    <button type="button" data-accordion-toggle="courses-accordion-content"
                        class="flex items-center justify-between w-full py-2.5 px-3 rounded-lg transition-all duration-200 cursor-pointer {{ $isCoursesActive ? 'bg-green-50 text-green-600' : 'text-gray-600 hover:bg-green-50 hover:text-green-600' }}">
                        <span class="flex items-center gap-3">
                            <i class="ti ti-book text-xl"></i>
                            <span class="font-medium">Courses</span>
                        </span>
                        <i
                            class="ti ti-chevron-down text-sm transition-transform duration-200 accordion-icon {{ $isCoursesActive ? 'rotate-180' : '' }}"></i>
                    </button>

                    <div id="courses-accordion-content"
                        class="w-full overflow-hidden transition-all duration-300 {{ $isCoursesActive ? '' : 'hidden' }}">
                        <ul class="mt-1 ml-4 pl-4 border-l-2 border-gray-200 space-y-1">
                            <li>
                                <a class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm transition-all duration-200 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('categories.*') ? 'text-green-600 bg-green-50 font-medium' : 'text-gray-500' }}"
                                    href="#">
                                    <i class="ti ti-point text-xs"></i>
                                    <span>Category</span>
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm transition-all duration-200 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('courses.*') ? 'text-green-600 bg-green-50 font-medium' : 'text-gray-500' }}"
                                    href="#">
                                    <i class="ti ti-point text-xs"></i>
                                    <span>Course List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</aside>
