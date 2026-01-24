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

            <div class="w-full lg:w-64 flex-shrink-0 z-20 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
                <nav
                    class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

                    <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">✒️</span> Hero Narrative
                    </button>

                    <button @click="activeTab = 'journey'" :class="activeTab === 'journey' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">👣</span> Journey (Zig-Zag)
                    </button>

                    <button @click="activeTab = 'values'" :class="activeTab === 'values' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">💎</span> Nilai Inti
                    </button>

                    <button @click="activeTab = 'extra'" :class="activeTab === 'extra' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
                        <span class="text-lg">📊</span> Statistik & Quote
                    </button>
                </nav>
            </div>

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">

                <div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Hero Narrative</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Bagian pembuka dengan gaya editorial.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Headline Besar</label>
                                <input type="text"
                                    class="input-about w-full border-gray-300 rounded-lg shadow-sm p-3 font-serif text-lg"
                                    value="Lebih dari Sekadar Destinasi.">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sub-Headline</label>
                                <textarea rows="4" class="input-about w-full border-gray-300 rounded-lg shadow-sm p-3 leading-relaxed">Ini adalah sebuah mimpi yang menjadi nyata. Ponorogo Dreamland menyatukan cita rasa kuliner, kehangatan tradisi, dan keceriaan keluarga dalam satu harmoni.</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Hero Photo (Blob Shape)</label>
                            <div
                                class="bg-gray-50 p-6 rounded-xl border border-dashed border-gray-300 flex flex-col items-center justify-center">
                                <div
                                    class="preview-blob w-48 h-48 md:w-64 md:h-64 shadow-xl relative group cursor-pointer bg-slate-200">
                                    <img src="https://images.unsplash.com/photo-1561582806-398d287178d6?q=80&w=600"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                        <span
                                            class="text-white text-xs font-bold border border-white px-2 py-1 rounded">Ubah
                                            Foto</span>
                                    </div>
                                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                                <p class="text-xs text-orange-500 mt-4 font-bold">⚠️ Penting: Gunakan foto rasio 1:1
                                    (Square) agar bentuk blob sempurna.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'journey'" class="p-4 md:p-8 space-y-8" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Cerita & Filosofi (Zig-Zag)</h2>
                        <p class="text-gray-500 text-xs md:text-sm">3 slot konten tetap yang akan tampil bergantian arah
                            (Kiri-Kanan-Kiri).</p>
                    </div>

                    <div class="border border-gray-200 rounded-xl p-4 bg-white relative">
                        <div
                            class="absolute -left-3 -top-3 w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
                            01</div>
                        <div class="flex flex-col md:flex-row gap-4 mt-2">
                            <div class="md:w-1/3">
                                <label class="block text-xs font-bold text-gray-500 mb-1">Foto (Kiri)</label>
                                <div
                                    class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden relative group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1528696892704-5f65b8252455?q=80&w=300"
                                        class="w-full h-full object-cover">
                                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                            </div>
                            <div class="md:w-2/3 space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Judul Cerita</label>
                                    <input type="text"
                                        class="input-about w-full border-gray-300 rounded text-sm font-bold"
                                        value="Awal Mula Mimpi">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Narasi</label>
                                    <textarea rows="3" class="input-about w-full border-gray-300 rounded text-sm text-gray-600">Berawal dari lahan kosong di jantung kota, kami melihat potensi...</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-xl p-4 bg-slate-50 relative">
                        <div
                            class="absolute -left-3 -top-3 w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
                            02</div>
                        <div class="text-right mb-2 text-xs text-orange-500 font-bold italic">⚡ Tampilan di website akan
                            terbalik (Foto di Kanan)</div>

                        <div class="flex flex-col md:flex-row-reverse gap-4">
                            <div class="md:w-1/3">
                                <label class="block text-xs font-bold text-gray-500 mb-1 text-right">Foto (Kanan)</label>
                                <div
                                    class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden relative group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1464695110811-dcf3903dc2f4?q=80&w=300"
                                        class="w-full h-full object-cover">
                                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                            </div>
                            <div class="md:w-2/3 space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Judul Cerita</label>
                                    <input type="text"
                                        class="input-about w-full border-gray-300 rounded text-sm font-bold"
                                        value="Filosofi Dreamland">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Narasi</label>
                                    <textarea rows="3" class="input-about w-full border-gray-300 rounded text-sm text-gray-600">Kami percaya setiap sudut tempat ini dirancang untuk mewujudkan mimpi...</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-xl p-4 bg-white relative">
                        <div
                            class="absolute -left-3 -top-3 w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
                            03</div>
                        <div class="flex flex-col md:flex-row gap-4 mt-2">
                            <div class="md:w-1/3">
                                <label class="block text-xs font-bold text-gray-500 mb-1">Foto (Kiri)</label>
                                <div
                                    class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden relative group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1581578731117-104f2a8d46a8?q=80&w=300"
                                        class="w-full h-full object-cover grayscale">
                                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                            </div>
                            <div class="md:w-2/3 space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Judul Cerita</label>
                                    <input type="text"
                                        class="input-about w-full border-gray-300 rounded text-sm font-bold"
                                        value="Komitmen Kami">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Narasi</label>
                                    <textarea rows="3" class="input-about w-full border-gray-300 rounded text-sm text-gray-600">Memberikan pelayanan setara hotel berbintang...</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'values'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Nilai Inti (Bento Grid)</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Kelola 3 kartu utama. Kartu ke-3 membutuhkan foto
                            background.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div
                                class="border-l-4 border-green-600 bg-white p-4 shadow-sm rounded-r-xl border border-gray-100">
                                <h3 class="text-xs font-bold text-green-800 uppercase mb-3">Card 1: Otentik</h3>
                                <div class="flex gap-2 mb-2">
                                    <input type="text" class="input-about w-16 border-gray-300 rounded text-center"
                                        value="🏛️">
                                    <input type="text" class="input-about w-full border-gray-300 rounded font-bold"
                                        value="Otentik">
                                </div>
                                <textarea rows="2" class="input-about w-full border-gray-300 rounded text-sm">Menjaga resep warisan leluhur dan arsitektur asli.</textarea>
                            </div>

                            <div
                                class="border-l-4 border-blue-500 bg-white p-4 shadow-sm rounded-r-xl border border-gray-100">
                                <h3 class="text-xs font-bold text-blue-800 uppercase mb-3">Card 2: Inovatif</h3>
                                <div class="flex gap-2 mb-2">
                                    <input type="text" class="input-about w-16 border-gray-300 rounded text-center"
                                        value="🚀">
                                    <input type="text" class="input-about w-full border-gray-300 rounded font-bold"
                                        value="Inovatif">
                                </div>
                                <textarea rows="2" class="input-about w-full border-gray-300 rounded text-sm">Terus berkembang dengan fasilitas modern.</textarea>
                            </div>
                        </div>

                        <div
                            class="border border-gray-200 rounded-xl overflow-hidden relative group h-full min-h-[250px] bg-slate-900">
                            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=400"
                                class="w-full h-full object-cover opacity-30">

                            <div class="absolute inset-0 p-6 flex flex-col justify-center">
                                <span class="text-xs font-bold text-yellow-400 uppercase mb-2">Card 3: Kehangatan</span>
                                <div class="flex gap-2 mb-2">
                                    <input type="text"
                                        class="bg-black/30 border-white/30 text-white w-12 rounded text-center focus:ring-0"
                                        value="🤝">
                                    <input type="text"
                                        class="bg-black/30 border-white/30 text-white w-full rounded font-bold focus:ring-0"
                                        value="Kehangatan">
                                </div>
                                <textarea rows="3" class="bg-black/30 border-white/30 text-white w-full rounded text-sm focus:ring-0">Pelayanan yang membuat Anda merasa seperti pulang.</textarea>
                            </div>

                            <div class="absolute bottom-4 right-4">
                                <label
                                    class="bg-white text-xs font-bold px-3 py-1 rounded cursor-pointer hover:bg-gray-200">
                                    Ganti Background
                                    <input type="file" class="hidden">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'extra'" class="p-4 md:p-8 space-y-8" x-transition.opacity>

                    <div>
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Statistik (Counter)</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-green-50 p-4 rounded-lg border border-green-100 text-center">
                                <label class="block text-xs font-bold text-green-800 mb-1">Label 1</label>
                                <input type="text" class="input-about w-full text-center text-sm mb-2"
                                    value="Unit Bisnis">
                                <label class="block text-xs font-bold text-green-800 mb-1">Angka</label>
                                <input type="number" class="input-about w-full text-center font-bold text-xl"
                                    value="3">
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg border border-green-100 text-center">
                                <label class="block text-xs font-bold text-green-800 mb-1">Label 2</label>
                                <input type="text" class="input-about w-full text-center text-sm mb-2"
                                    value="Pengunjung">
                                <label class="block text-xs font-bold text-green-800 mb-1">Angka (+)</label>
                                <input type="number" class="input-about w-full text-center font-bold text-xl"
                                    value="1000">
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg border border-green-100 text-center">
                                <label class="block text-xs font-bold text-green-800 mb-1">Label 3</label>
                                <input type="text" class="input-about w-full text-center text-sm mb-2"
                                    value="Lokal Ponorogo">
                                <label class="block text-xs font-bold text-green-800 mb-1">Persentase (%)</label>
                                <input type="number" class="input-about w-full text-center font-bold text-xl"
                                    value="100">
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Founder Quote</h2>
                        <div class="bg-slate-800 p-6 rounded-xl text-white">
                            <div class="text-4xl text-yellow-500 font-serif mb-2">“</div>
                            <textarea rows="3"
                                class="w-full bg-slate-700 border-slate-600 rounded-lg text-lg font-serif mb-4 focus:ring-yellow-500 focus:border-yellow-500">Kami ingin menciptakan tempat di mana teknologi dan tradisi tidak saling bertentangan.</textarea>

                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label class="block text-xs text-slate-400 mb-1">Nama / Jabatan</label>
                                    <input type="text" class="w-full bg-slate-700 border-slate-600 rounded text-sm"
                                        value="Founder">
                                </div>
                                <div class="w-1/2">
                                    <label class="block text-xs text-slate-400 mb-1">Sub Jabatan</label>
                                    <input type="text" class="w-full bg-slate-700 border-slate-600 rounded text-sm"
                                        value="Ponorogo Dreamland">
                                </div>
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
            Alpine.data('aboutCMS', () => ({
                activeTab: 'hero',
            }))
        })
    </script>
@endsection
