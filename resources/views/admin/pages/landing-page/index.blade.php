@extends('admin.layouts.app')

@section('style')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

            <div class="w-full lg:w-64 flex-shrink-0 z-20 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
                <nav
                    class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

                    <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Hero Section
                    </button>

                    <button @click="activeTab = 'about'" :class="activeTab === 'about' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang Kami
                    </button>

                    <button @click="activeTab = 'why'" :class="activeTab === 'why' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Why Choose Us
                    </button>

                    <button @click="activeTab = 'moment'" :class="activeTab === 'moment' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Momen Spesial
                    </button>
                </nav>
            </div>

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[500px]">

                <div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Edit Hero Section</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Bagian paling atas website.</p>
                    </div>

                    <div class="grid gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Main Headline</label>
                            <input type="text"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-3"
                                value="Ponorogo Dreamland: Destinasi Terpadu untuk Kuliner, Tradisi, dan Rekreasi.">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Sub Headline</label>
                            <textarea rows="3"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-3">Nikmati pengalaman tak terlupakan bersama keluarga di pusat kenyamanan dan kehangatan kota Ponorogo.</textarea>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Carousel Images</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                            <div class="group relative rounded-lg overflow-hidden border border-gray-200 aspect-video">
                                <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=400"
                                    class="w-full h-full object-cover">
                                <button
                                    class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded shadow-md opacity-100 md:opacity-0 group-hover:opacity-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="group relative rounded-lg overflow-hidden border border-gray-200 aspect-video">
                                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=400"
                                    class="w-full h-full object-cover">
                                <button
                                    class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded shadow-md opacity-100 md:opacity-0 group-hover:opacity-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <label
                                class="cursor-pointer file-zone rounded-lg flex flex-col items-center justify-center aspect-video bg-gray-50 text-gray-400 hover:text-green-600">
                                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="text-xs font-bold">Upload</span>
                                <input type="file" class="hidden" multiple>
                            </label>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'about'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Edit Tentang Kami</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Section</label>
                                <input type="text" class="w-full border-gray-300 rounded-lg shadow-sm p-3"
                                    value="Mewujudkan Mimpi di Tanah Ponorogo">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Lengkap</label>
                                <textarea rows="6" class="w-full border-gray-300 rounded-lg shadow-sm p-3">Ponorogo Dreamland lahir dari sebuah mimpi sederhana...</textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-gray-700">Foto Ilustrasi (Max 2)</label>

                            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                                <img src="https://images.unsplash.com/photo-1605218427368-35b80a37e296?q=80&w=200"
                                    class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md bg-gray-200">
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-xs md:text-sm font-bold text-gray-700 mb-1">Foto Kiri</p>
                                    <input type="file" class="text-xs w-full text-gray-500">
                                </div>
                            </div>

                            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                                <img src="https://images.unsplash.com/photo-1561582806-398d287178d6?q=80&w=200"
                                    class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md bg-gray-200">
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-xs md:text-sm font-bold text-gray-700 mb-1">Foto Kanan</p>
                                    <input type="file" class="text-xs w-full text-gray-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'why'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Why Choose Us</h2>
                        <span class="text-[10px] md:text-xs bg-gray-200 text-gray-500 font-bold px-2 py-1 rounded">
                            Full (4/4)
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border border-gray-200 p-4 rounded-xl hover:shadow-md transition bg-white group">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                                    📍</div>
                                <div class="flex-1 space-y-2 min-w-0">
                                    <input type="text"
                                        class="w-full text-sm font-bold border-0 border-b border-gray-200 focus:ring-0 px-0 py-1"
                                        value="Lokasi Strategis">
                                    <textarea rows="2" class="w-full text-xs text-gray-600 border-0 bg-gray-50 rounded p-2 focus:ring-0">Mudah dijangkau, tepat di jantung aktivitas.</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="border border-gray-200 p-4 rounded-xl hover:shadow-md transition bg-white group">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                                    ✨</div>
                                <div class="flex-1 space-y-2 min-w-0">
                                    <input type="text"
                                        class="w-full text-sm font-bold border-0 border-b border-gray-200 focus:ring-0 px-0 py-1"
                                        value="Fasilitas Lengkap">
                                    <textarea rows="2" class="w-full text-xs text-gray-600 border-0 bg-gray-50 rounded p-2 focus:ring-0">One-stop destination untuk keluarga.</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div x-show="activeTab === 'moment'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Momen Spesial</h2>
                        <span class="text-xs md:text-sm font-medium text-orange-500">4 / 4 Slot</span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                        <div class="group relative aspect-square rounded-xl overflow-hidden shadow-sm">
                            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=400"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">
                                <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                                <span class="text-white text-xs font-bold">Ubah</span>
                            </div>
                            <button class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full shadow-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="group relative aspect-square rounded-xl overflow-hidden shadow-sm">
                            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=400"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">
                                <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                                <span class="text-white text-xs font-bold">Ubah</span>
                            </div>
                            <button class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full shadow-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
