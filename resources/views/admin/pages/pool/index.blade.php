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

        /* Custom Pool Theme (Waterfall Blue) */
        .input-pool:focus {
            --tw-ring-color: #0288D1;
            border-color: #0288D1;
        }

        /* Range Slider Custom Styling */
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #0288D1;
            cursor: pointer;
            margin-top: -8px;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 4px;
            cursor: pointer;
            background: #E5E7EB;
            border-radius: 2px;
        }

        /* Tab States */
        .tab-active {
            background-color: #E0F2F1;
            /* Cyan/Blue-50 mix */
            color: #0277BD;
            /* Darker Blue */
            border-color: #0277BD;
        }

        .tab-inactive {
            color: #6B7280;
            border-color: transparent;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="poolCMS()">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">New
                        Project</span>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Pool & Oasis Manager</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1">Atur countdown peluncuran dan update progres pembangunan.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="#"
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 flex items-center gap-2 text-sm font-medium transition">
                    Live Preview
                </a>
                <button
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-accent text-white rounded-lg hover:bg-[#01579B] flex items-center gap-2 text-sm font-medium shadow-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    Update Status
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">

            @include('admin.pages.pool.partials.sidebar')

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">
                @include('admin.pages.pool.panes.hero')
                @include('admin.pages.pool.panes.sneak')
                @include('admin.pages.pool.panes.timeline')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('poolCMS', () => ({
                activeTab: 'timeline', // Default tab for demo purposes

                // DUMMY DATA FOR TIMELINE
                timeline: [{
                        title: 'Perencanaan & Desain',
                        date: 'Selesai - Des 2025',
                        desc: 'Finalisasi desain arsitektur 3D.',
                        status: 'done',
                        percent: 100
                    },
                    {
                        title: 'Konstruksi Fisik',
                        date: 'Sekarang - Jan 2026',
                        desc: 'Pengerjaan struktur utama kolam.',
                        status: 'progress',
                        percent: 70
                    },
                    {
                        title: 'Finishing',
                        date: 'Estimasi: Mar 2026',
                        desc: 'Pemasangan keramik dan lighting.',
                        status: 'planned',
                        percent: 0
                    }
                ],

                addStage() {
                    this.timeline.push({
                        title: 'Tahap Baru',
                        date: '...',
                        desc: '...',
                        status: 'planned',
                        percent: 0
                    });
                },

                removeStage(index) {
                    if (confirm('Hapus tahap ini?')) {
                        this.timeline.splice(index, 1);
                    }
                }
            }))
        })
    </script>
@endsection
