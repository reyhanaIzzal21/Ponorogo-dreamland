@extends('admin.layouts.app')

@section('style')
    <style>
        /* Hide Scrollbar for Horizontal Nav */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom Resto Theme for Admin Inputs */
        .input-resto:focus {
            --tw-ring-color: #2D7D32;
            /* Heritage Red */
            border-color: #2D7D32;
        }

        /* Active Tab State Styling */
        .tab-active {
            background-color: #f4fef2;
            /* Red-50 */
            color: #2D7D32;
            border-color: #2D7D32;
        }

        .tab-inactive {
            color: #6B7280;
            border-color: transparent;
        }

        .tab-inactive:hover {
            background-color: #F9FAFB;
            color: #374151;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="restaurantCMS()">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2">
                    <span class="bg-green-100 text-primary text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Resto
                        Module</span>
                    <h1 class="text-2xl font-bold text-gray-800">Dam Cokro Manager</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1">Atur konten visual dan menu unggulan restoran.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="{{ route('dam-cokro-resto') }}" target="_blank"
                    class="flex-1 md:flex-none px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-bold shadow-sm transition text-center">
                    👁️ Preview
                </a>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">

            @include('admin.pages.restaurant.partials.sidebar')

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">

                @include('admin.pages.restaurant.panes.hero')
                @include('admin.pages.restaurant.panes.menu')
                @include('admin.pages.restaurant.panes.filosofi')
                @include('admin.pages.restaurant.panes.gallery')

            </div>
        </div>

        <!-- Toast Notification -->
        <div x-show="showToast" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            class="fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50"
            :class="toastType === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'">
            <span x-text="toastMessage"></span>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.pages.restaurant.scripts.index')
@endsection
