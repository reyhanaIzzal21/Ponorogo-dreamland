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
                    class="flex-1 md:flex-none px-4 py-2 bg-[#B71C1C] text-white rounded-lg hover:bg-red-800 text-sm font-bold shadow-lg transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Publish
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">

            <div class="w-full lg:w-64 flex-shrink-0 z-10 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
                <nav
                    class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

                    <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
                        <span class="text-lg">🖼️</span> Hero Section
                    </button>

                    <button @click="activeTab = 'menu'" :class="activeTab === 'menu' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
                        <span class="text-lg">🍲</span> Best Seller
                    </button>

                    <button @click="activeTab = 'filosofi'"
                        :class="activeTab === 'filosofi' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
                        <span class="text-lg">📜</span> Filosofi
                    </button>

                    <button @click="activeTab = 'gallery'" :class="activeTab === 'gallery' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
                        <span class="text-lg">📸</span> Galeri & Sosmed
                    </button>
                </nav>
            </div>

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">

                <div x-show="activeTab === 'hero'" class="p-6 md:p-8 space-y-8" x-transition.opacity>
                    <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Hero Section</h2>
                            <p class="text-xs text-gray-400">Tampilan utama saat user masuk halaman resto.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Main Title</label>
                                <input type="text"
                                    class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3 font-serif text-xl"
                                    value="Cita Rasa Tradisional di Jantung Ponorogo">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Sub Title</label>
                                <textarea class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3 h-32">Nikmati hidangan warisan leluhur dengan sentuhan modern, disajikan dalam kehangatan suasana kekeluargaan.</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Background Image</label>
                            <div
                                class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-[#B71C1C] transition cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=800"
                                    class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-500">
                                <div
                                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition">
                                    <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-white text-xs font-bold">Ganti Background</span>
                                </div>
                                <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                            <p class="text-xs text-gray-400 mt-2 text-center">Disarankan ukuran 1920x1080px (Landscape)</p>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'menu'" class="p-6 md:p-8 space-y-8" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-xl font-bold text-gray-800">Menu Best Seller</h2>
                        <p class="text-xs text-gray-400">Pilih 3 menu dari database untuk ditampilkan di halaman depan.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <div class="flex flex-col md:flex-row gap-4 items-center">
                                <div class="w-full md:w-1/2">
                                    <label class="block text-xs font-bold text-[#B71C1C] uppercase mb-2">Slot 1 (Highlight
                                        Utama)</label>
                                    <select x-model="slot1"
                                        class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                                        <template x-for="menu in menus" :key="menu.id">
                                            <option :value="menu.id" x-text="menu.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div
                                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <img :src="getMenu(slot1).image" class="w-16 h-16 rounded-md object-cover bg-gray-200">
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot1).name"></p>
                                        <p class="text-xs text-[#B71C1C] font-bold" x-text="getMenu(slot1).price"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <div class="flex flex-col md:flex-row gap-4 items-center">
                                <div class="w-full md:w-1/2">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Slot 2</label>
                                    <select x-model="slot2"
                                        class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                                        <template x-for="menu in menus" :key="menu.id">
                                            <option :value="menu.id" x-text="menu.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div
                                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <img :src="getMenu(slot2).image" class="w-16 h-16 rounded-md object-cover bg-gray-200">
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot2).name"></p>
                                        <p class="text-xs text-[#B71C1C] font-bold" x-text="getMenu(slot2).price"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <div class="flex flex-col md:flex-row gap-4 items-center">
                                <div class="w-full md:w-1/2">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Slot 3</label>
                                    <select x-model="slot3"
                                        class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                                        <template x-for="menu in menus" :key="menu.id">
                                            <option :value="menu.id" x-text="menu.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div
                                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <img :src="getMenu(slot3).image"
                                        class="w-16 h-16 rounded-md object-cover bg-gray-200">
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot3).name"></p>
                                        <p class="text-xs text-[#B71C1C] font-bold" x-text="getMenu(slot3).price"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'filosofi'" class="p-6 md:p-8 space-y-8" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-xl font-bold text-gray-800">Filosofi Kami</h2>
                        <p class="text-xs text-gray-400">Cerita di balik nama dan rasa Dam Cokro.</p>
                    </div>

                    <div class="bg-[#FFF8E1] p-6 rounded-2xl border border-[#FBC02D]">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-[#B71C1C] uppercase mb-2">Judul Filosofi</label>
                                <input type="text" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3"
                                    value="Lebih dari Sekadar Tempat Makan">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#B71C1C] uppercase mb-2">Isi Cerita</label>
                                <textarea class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3 h-48 font-light leading-relaxed">"Dam Cokro" bukan hanya nama, tapi sebuah janji. Diambil dari semangat menjaga aliran tradisi agar tetap jernih dan menghidupi.

Kami bekerja sama langsung dengan petani lokal Ponorogo untuk mendapatkan rempah terbaik. Proses memasak kami masih mempertahankan teknik 'slow cooking'.</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'gallery'" class="p-6 md:p-8 space-y-8" x-transition.opacity>

                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <label class="block text-sm font-bold text-gray-700">Sudut Estetik (Maksimal 4 Foto)</label>
                            <span class="text-xs font-medium bg-gray-100 px-2 py-1 rounded">4/4 Terisi</span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="relative group aspect-square rounded-xl overflow-hidden shadow-sm bg-gray-100">
                                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=300"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center cursor-pointer">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="relative group aspect-square rounded-xl overflow-hidden shadow-sm bg-gray-100">
                                <img src="https://images.unsplash.com/photo-1550966871-3ed3c6227685?q=80&w=300"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center cursor-pointer">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="relative group aspect-square rounded-xl overflow-hidden shadow-sm bg-gray-100">
                                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=300"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center cursor-pointer">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div
                                class="relative group aspect-square rounded-xl overflow-hidden shadow-sm bg-gray-100 border-2 border-dashed border-gray-300 hover:border-[#B71C1C] transition cursor-pointer flex items-center justify-center">
                                <img src="https://images.unsplash.com/photo-1592861956120-e524fc739696?q=80&w=300"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-4">Integrasi Sosial Media</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative">
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Instagram
                                    Username</label>
                                <div class="flex items-center">
                                    <span
                                        class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg px-3 py-3 text-gray-500">@</span>
                                    <input type="text"
                                        class="input-resto w-full rounded-r-lg border-gray-300 shadow-sm p-3"
                                        value="ponorogo.dreamland">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Direct Link
                                    (URL)</label>
                                <input type="url" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3"
                                    value="https://instagram.com/ponorogo.dreamland">
                            </div>
                        </div>
                    </div>
                </div>

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
