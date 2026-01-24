@extends('admin.layouts.app')

@section('style')
    <style>
        /* Hide Scrollbar */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom Pendopo Theme (Earth Colors) */
        .input-pendopo:focus {
            --tw-ring-color: #795548;
            /* Earth Brown */
            border-color: #795548;
        }

        /* Tab States */
        .tab-active {
            background-color: #fdf5f2;
            /* Orange/Brown-50 */
            color: #795548;
            border-color: #795548;
        }

        .tab-inactive {
            color: #6B7280;
            border-color: transparent;
        }

        /* Card Hover Effect */
        .edit-card {
            transition: all 0.2s ease;
        }

        .edit-card:hover {
            border-color: #795548;
            transform: translateY(-2px);
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="pendopoCMS()">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2">
                    <span
                        class="bg-orange-100 text-orange-800 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Venue
                        Module</span>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Pendopo Manager</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1">Kelola spesifikasi ruang, fasilitas, dan layout acara.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="#"
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 flex items-center gap-2 text-sm font-medium transition">
                    Live Preview
                </a>
                <button
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-earth text-white rounded-lg hover:bg-[#5D4037] flex items-center gap-2 text-sm font-medium shadow-lg transition">
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

            @include('admin.pages.pavilion.partials.sidebar')

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">

                @include('admin.pages.pavilion.panes.hero')
                @include('admin.pages.pavilion.panes.specs')
                @include('admin.pages.pavilion.panes.facilities')
                @include('admin.pages.pavilion.panes.flexibility')

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pendopoCMS', () => ({
                activeTab: 'hero',

                // 2. DUMMY DATA: Venue Specs (Max 4)
                specs: [{
                        title: 'Kapasitas Tamu',
                        desc: '500 - 800 (Standing)'
                    },
                    {
                        title: 'Dimensi Ruang',
                        desc: '20 x 30 Meter'
                    },
                    {
                        title: 'Material Lantai',
                        desc: 'Granit HQ'
                    },
                    {
                        title: 'Kenyamanan',
                        desc: 'Semi-Outdoor'
                    }
                ],

                // 3. DUMMY DATA: Fasilitas (Unlimited)
                facilities: [{
                        icon: '🔊',
                        title: 'Sound System Standard',
                        desc: '4 Speaker Aktif, Mixer, 2 Wireless Mic.'
                    },
                    {
                        icon: '💡',
                        title: 'Lighting Estetik',
                        desc: 'Lampu gantung Jawa & sorot area.'
                    },
                    {
                        icon: '🚪',
                        title: 'Ruang Transit',
                        desc: 'Privat room untuk VIP/Pengantin.'
                    }
                ],

                // 4. DUMMY DATA: Flexibility (Unlimited)
                flexibility: [{
                        title: 'Wedding Setup',
                        image: 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=300'
                    },
                    {
                        title: 'Seminar Layout',
                        image: 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=300'
                    },
                ],

                // Actions
                addSpec() {
                    if (this.specs.length < 4) {
                        this.specs.push({
                            title: 'Baru',
                            desc: '...'
                        });
                    }
                },
                removeSpec(index) {
                    this.specs.splice(index, 1);
                },

                addFacility() {
                    this.facilities.push({
                        icon: '✨',
                        title: '',
                        desc: ''
                    });
                },
                removeFacility(index) {
                    this.facilities.splice(index, 1);
                },

                addFlexibility() {
                    // In real app, this triggers file upload dialog
                    this.flexibility.push({
                        title: 'Layout Baru',
                        image: 'https://via.placeholder.com/300?text=New+Image'
                    });
                },
                removeFlexibility(index) {
                    this.flexibility.splice(index, 1);
                }
            }))
        })
    </script>
@endsection
