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
            --tw-ring-color: #B71C1C;
            /* Heritage Red */
            border-color: #B71C1C;
        }

        /* Active Tab State Styling */
        .tab-active {
            background-color: #FEF2F2;
            /* Red-50 */
            color: #B71C1C;
            border-color: #B71C1C;
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
                    <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Resto
                        Module</span>
                    <h1 class="text-2xl font-bold text-gray-800">Dam Cokro Manager</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1">Atur konten visual dan menu unggulan restoran.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <button
                    class="flex-1 md:flex-none px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-bold shadow-sm transition">
                    👁️ Preview
                </button>
                <button
                    class="flex-1 md:flex-none px-4 py-2 bg-heritage-red text-white rounded-lg hover:bg-red-800 text-sm font-bold shadow-lg transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Publish
                </button>
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
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('restaurantCMS', () => ({
                activeTab: 'hero',

                // DUMMY DATA FOR BEST SELLER DROPDOWN
                // Dalam real app, ini di-passing dari Controller: $menus
                menus: [{
                        id: 1,
                        name: 'Sate Ponorogo Premium',
                        price: 'Rp 35.000',
                        image: 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=200'
                    },
                    {
                        id: 2,
                        name: 'Nasi Pecel Pincuk',
                        price: 'Rp 18.000',
                        image: 'https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=200'
                    },
                    {
                        id: 3,
                        name: 'Es Dawet Jabung',
                        price: 'Rp 12.000',
                        image: 'https://images.unsplash.com/photo-1544025162-d76690b67f14?q=80&w=200'
                    },
                    {
                        id: 4,
                        name: 'Ayam Lodho',
                        price: 'Rp 28.000',
                        image: 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=200'
                    },
                    {
                        id: 5,
                        name: 'Rawon Setan',
                        price: 'Rp 30.000',
                        image: 'https://images.unsplash.com/photo-1626804475297-411dbe11261c?q=80&w=200'
                    },
                ],

                // Selected IDs (Default value)
                slot1: 1,
                slot2: 2,
                slot3: 3,

                // Helper to get menu object by ID
                getMenu(id) {
                    return this.menus.find(m => m.id == id) || {
                        name: 'Pilih Menu',
                        price: '-',
                        image: ''
                    };
                }
            }))
        })
    </script>
@endsection
