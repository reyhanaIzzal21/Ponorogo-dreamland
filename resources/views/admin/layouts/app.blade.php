<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo-nobg.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <title>Admin - @yield('title', 'Dashboard')</title>
    @yield('style')
    @stack('style')
</head>

<body class="bg-slate-50 font-sans antialiased">

    <!-- Sidebar Backdrop for Mobile -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-[55] hidden xl:hidden"
        onclick="closeSidebarAdminDashboard()"></div>

    <!--start the project-->
    <main>
        <div id="main-wrapper" class="flex min-h-screen">
            @include('admin.layouts.sidebar')

            <!-- Page Wrapper with responsive margin -->
            <div class="w-full xl:ml-[270px] flex flex-col min-h-screen transition-all duration-300">
                <!-- HEADER -->
                <div class="shrink-0">
                    @include('admin.layouts.header')
                </div>

                <!-- CONTENT -->
                <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                    @yield('content')

                    {{-- global components modal --}}
                    @include('components.delete-modal-component')
                </main>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <!-- Custom Dashboard Navigation Script -->
    @include('admin.layouts.scripts.dashboard-navigation')

    @yield('script')
    @stack('script')
</body>

</html>
