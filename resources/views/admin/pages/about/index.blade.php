@extends('admin.layouts.app')

@section('style')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Hide Scrollbar */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom About Theme (Slate/Corporate) */
        .input-about:focus {
            --tw-ring-color: #475569;
            /* Slate-600 */
            border-color: #475569;
        }

        /* Tab States */
        .tab-active {
            background-color: #F1F5F9;
            /* Slate-100 */
            color: #334155;
            /* Slate-700 */
            border-color: #334155;
        }

        .tab-inactive {
            color: #94A3B8;
            border-color: transparent;
        }

        /* Blob Preview Shape (Mimic Frontend) */
        .preview-blob {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            transition: border-radius 1s ease-in-out;
            overflow: hidden;
        }

        .preview-blob:hover {
            border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="aboutCMS()">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2">
                    <span
                        class="bg-slate-200 text-slate-800 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Brand
                        Identity</span>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">About Page Manager</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1">Kelola narasi, sejarah, dan nilai inti perusahaan.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="#"
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 flex items-center gap-2 text-sm font-medium transition">
                    Live Preview
                </a>
                <button
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-800 flex items-center gap-2 text-sm font-medium shadow-lg transition">
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

            @include('admin.pages.about.partials.sidebar')

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">
                @include('admin.pages.about.panes.hero')
                @include('admin.pages.about.panes.journey')
                @include('admin.pages.about.panes.value')
                @include('admin.pages.about.panes.extra')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('aboutCMS', () => ({
                activeTab: 'hero',
            }))
        })
    </script>
@endsection
