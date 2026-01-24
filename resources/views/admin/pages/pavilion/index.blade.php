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
                    class="flex-1 md:flex-none justify-center px-4 py-2 bg-[#795548] text-white rounded-lg hover:bg-[#5D4037] flex items-center gap-2 text-sm font-medium shadow-lg transition">
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

            <div class="w-full lg:w-64 flex-shrink-0 z-20 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
                <nav
                    class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

                    <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">🏛️</span> Hero Section
                    </button>

                    <button @click="activeTab = 'specs'" :class="activeTab === 'specs' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">📏</span> Venue Specs
                    </button>

                    <button @click="activeTab = 'facilities'"
                        :class="activeTab === 'facilities' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">🛠️</span> Fasilitas Inklusif
                    </button>

                    <button @click="activeTab = 'flexibility'"
                        :class="activeTab === 'flexibility' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">📐</span> Fleksibilitas Ruang
                    </button>
                </nav>
            </div>

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">

                <div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Hero Section</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Tampilan utama halaman Pendopo.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Main Title</label>
                                <input type="text"
                                    class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3 font-serif"
                                    value="Ruang Elegan untuk Momen Istimewa Anda">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sub Title / Deskripsi</label>
                                <textarea rows="4" class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3">Pendopo Ponorogo Dreamland menghadirkan perpaduan arsitektur tradisional dan fasilitas modern untuk berbagai kebutuhan acara.</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Background Image</label>
                            <div
                                class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-[#795548] transition cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1519225421980-715cb0202128?q=80&w=600"
                                    class="w-full h-full object-cover opacity-90">
                                <div
                                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition">
                                    <span class="text-white text-xs font-bold bg-black/50 px-3 py-1 rounded-full">Ganti
                                        Foto</span>
                                </div>
                                <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'specs'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg md:text-xl font-bold text-gray-800">Spesifikasi Ruang</h2>
                            <p class="text-gray-500 text-xs md:text-sm">Data teknis venue (Maksimal 4).</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-gray-600">Slot Terpakai:</span>
                            <span class="px-2 py-1 rounded bg-orange-100 text-[#795548] font-bold text-xs"
                                x-text="specs.length + '/4'"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-xl">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Section Title</label>
                            <input type="text" class="input-pendopo w-full bg-white border-gray-200 rounded p-2 text-sm"
                                value="Spesifikasi Venue">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Sub-Title</label>
                            <input type="text" class="input-pendopo w-full bg-white border-gray-200 rounded p-2 text-sm"
                                value="Detail teknis untuk kebutuhan Anda">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <template x-for="(item, index) in specs" :key="index">
                            <div class="edit-card border border-gray-200 rounded-xl p-4 relative group bg-white">
                                <button @click="removeSpec(index)"
                                    class="absolute top-2 right-2 text-gray-400 hover:text-red-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                                        </path>
                                    </svg>
                                </button>

                                <div class="space-y-3 pr-6">
                                    <div>
                                        <label class="block text-[10px] uppercase font-bold text-gray-400">Judul
                                            Spec</label>
                                        <input type="text" x-model="item.title"
                                            class="input-pendopo w-full border-b border-gray-200 focus:border-[#795548] text-sm font-bold text-gray-800 p-0 pb-1 border-t-0 border-x-0 focus:ring-0">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] uppercase font-bold text-gray-400">Nilai /
                                            Detail</label>
                                        <input type="text" x-model="item.desc"
                                            class="input-pendopo w-full border-b border-gray-200 focus:border-[#795548] text-sm text-gray-600 p-0 pb-1 border-t-0 border-x-0 focus:ring-0">
                                    </div>
                                </div>
                            </div>
                        </template>

                        <button x-show="specs.length < 4" @click="addSpec()"
                            class="border-2 border-dashed border-gray-300 rounded-xl p-4 flex flex-col items-center justify-center text-gray-400 hover:text-[#795548] hover:border-[#795548] hover:bg-orange-50 transition h-full min-h-[120px]">
                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            <span class="text-xs font-bold">Tambah Data</span>
                        </button>
                    </div>
                </div>

                <div x-show="activeTab === 'facilities'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Fasilitas Inklusif</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Item yang didapatkan penyewa.</p>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Utama</label>
                            <input type="text" class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3"
                                value="Segala yang Anda Butuhkan">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Utama</label>
                            <textarea rows="2" class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3">Kami memahami bahwa kelancaran acara bergantung pada fasilitas pendukung.</textarea>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(fac, index) in facilities" :key="index">
                            <div
                                class="flex flex-col md:flex-row gap-4 p-4 border border-gray-200 rounded-xl bg-gray-50 items-start md:items-center group">
                                <div
                                    class="w-12 h-12 bg-white rounded-lg border border-gray-200 flex items-center justify-center text-2xl flex-shrink-0 cursor-pointer hover:border-[#795548]">
                                    <span x-text="fac.icon"></span>
                                </div>

                                <div class="flex-1 w-full space-y-2 md:space-y-0 md:grid md:grid-cols-2 md:gap-4">
                                    <input type="text" x-model="fac.title"
                                        class="input-pendopo w-full border-gray-300 rounded bg-white text-sm font-bold"
                                        placeholder="Nama Fasilitas">
                                    <input type="text" x-model="fac.desc"
                                        class="input-pendopo w-full border-gray-300 rounded bg-white text-sm text-gray-600"
                                        placeholder="Deskripsi Singkat">
                                </div>

                                <button @click="removeFacility(index)"
                                    class="text-red-400 hover:text-red-600 p-2 md:self-center self-end">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <button @click="addFacility()"
                            class="w-full py-3 border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:border-[#795548] hover:text-[#795548] hover:bg-orange-50 transition flex items-center justify-center gap-2 font-bold text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Tambah Fasilitas
                        </button>
                    </div>
                </div>

                <div x-show="activeTab === 'flexibility'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Fleksibilitas & Layout</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Galeri layout acara yang mungkin dilakukan.</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <template x-for="(layout, index) in flexibility" :key="index">
                            <div
                                class="group relative aspect-square rounded-xl overflow-hidden bg-gray-100 shadow-sm border border-gray-200">
                                <img :src="layout.image" class="w-full h-full object-cover">

                                <div
                                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition p-4 flex flex-col justify-between">
                                    <div class="flex justify-end">
                                        <button @click="removeFlexibility(index)"
                                            class="text-red-400 hover:text-red-500"><svg class="w-5 h-5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg></button>
                                    </div>
                                    <div>
                                        <input type="text" x-model="layout.title"
                                            class="w-full bg-transparent border-b border-white/50 text-white text-xs font-bold focus:border-white focus:ring-0 p-0 pb-1"
                                            placeholder="Nama Layout">
                                        <div
                                            class="mt-2 text-[10px] text-gray-300 cursor-pointer hover:text-white flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                            Ganti Foto
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <button @click="addFlexibility()"
                            class="aspect-square border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center text-gray-400 hover:text-[#795548] hover:border-[#795548] hover:bg-orange-50 transition">
                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="text-xs font-bold text-center">Upload<br>Layout Baru</span>
                        </button>
                    </div>
                </div>

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
