@extends('admin.layouts.app')

@section('style')
    <style>
        /* Utility untuk menyembunyikan scrollbar tapi tetap bisa di-scroll (UX Mobile) */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom File Input Zone */
        .file-zone {
            border: 2px dashed #e5e7eb;
            transition: all 0.3s ease;
        }

        .file-zone:hover {
            border-color: #2D7D32;
            background-color: #f0fdf4;
        }

        /* Tab Active State */
        .tab-active {
            background-color: #dcfce7;
            /* green-100 */
            color: #166534;
            /* green-800 */
            border-color: #166534;
        }

        .tab-inactive {
            color: #4b5563;
            /* gray-600 */
            border-color: transparent;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 min-h-screen bg-gray-50" x-data="{ activeTab: 'hero' }">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">Landing Page Manager</h1>
                <p class="text-gray-500 text-sm">Kelola konten halaman depan.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="/" target="_blank"
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 flex items-center gap-2 text-sm font-medium transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    <span class="hidden sm:inline">Live</span> Preview
                </a>
                <button
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 flex items-center gap-2 text-sm font-medium shadow-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    Simpan
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">

            @include('admin.pages.landing-page.partials.sidebar')

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[500px]">

                @include('admin.pages.landing-page.panes.hero')
                @include('admin.pages.landing-page.panes.about')
                @include('admin.pages.landing-page.panes.why')
                @include('admin.pages.landing-page.panes.moment')

            </div>
        </div>
    </div>
@endsection
