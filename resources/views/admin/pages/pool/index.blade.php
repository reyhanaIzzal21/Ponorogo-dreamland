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

            <div class="w-full lg:w-64 shrink-0 z-20 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
                <nav
                    class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

                    <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 shrink-0">
                        <span class="text-lg">⏱️</span> Hero & Countdown
                    </button>

                    <button @click="activeTab = 'sneak'" :class="activeTab === 'sneak' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 shrink-0">
                        <span class="text-lg">👀</span> Sneak Peek (Bento)
                    </button>

                    <button @click="activeTab = 'timeline'"
                        :class="activeTab === 'timeline' ? 'tab-active' : 'tab-inactive'"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 shrink-0">
                        <span class="text-lg">🏗️</span> Project Timeline
                    </button>

                </nav>
            </div>

            <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px]">

                <div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Hero Teaser</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Atur pesan pembuka dan target waktu peluncuran.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Badge Text</label>
                                <input type="text"
                                    class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3 font-mono text-sm"
                                    value="COMING SOON 2026">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Main Headline</label>
                                <input type="text"
                                    class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3 font-bold"
                                    value="The New Oasis in Town">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sub Headline</label>
                                <textarea rows="3" class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3">Segarkan hari Anda di destinasi terbaru Ponorogo. Perpaduan kesejukan air dan estetika modern.</textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl">
                                <label class="block text-sm font-bold text-blue-800 mb-2">📅 Target Launching Date</label>
                                <p class="text-xs text-blue-600 mb-3">Sistem akan otomatis menghitung mundur (Countdown)
                                    berdasarkan tanggal ini.</p>
                                <input type="date" class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3"
                                    value="2026-03-01">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Teaser Background (3D
                                    Render)</label>
                                <div
                                    class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-[#0288D1] transition cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=600"
                                        class="w-full h-full object-cover opacity-80 mix-blend-multiply">
                                    <div
                                        class="absolute inset-0 flex flex-col items-center justify-center bg-blue-900/40 opacity-0 group-hover:opacity-100 transition">
                                        <span
                                            class="text-white text-xs font-bold border border-white px-3 py-1 rounded-full">Ganti
                                            Render</span>
                                    </div>
                                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'sneak'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Sneak Peek Experience</h2>
                        <p class="text-gray-500 text-xs md:text-sm">Kelola 4 slot konten bento grid.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group">
                            <span
                                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                                1 (Utama/Besar)</span>
                            <div class="mt-6 space-y-3">
                                <input type="text" class="input-pool w-full border-gray-300 rounded text-sm font-bold"
                                    value="Family & Kids Friendly">
                                <textarea rows="2" class="input-pool w-full border-gray-300 rounded text-xs text-gray-600">Wahana air aman untuk keluarga.</textarea>
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1572331165267-854da2b00dc1?q=80&w=100"
                                        class="w-12 h-12 rounded object-cover bg-gray-100">
                                    <input type="file" class="text-xs text-gray-500">
                                </div>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group">
                            <span
                                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                                2 (Iconic)</span>
                            <div class="mt-6 space-y-3">
                                <div class="flex gap-2">
                                    <select class="input-pool border-gray-300 rounded text-sm w-1/3">
                                        <option>📸</option>
                                        <option>🏊‍♂️</option>
                                        <option>🍹</option>
                                    </select>
                                    <input type="text" class="input-pool w-2/3 border-gray-300 rounded text-sm font-bold"
                                        value="Aesthetic Poolside">
                                </div>
                                <input type="text"
                                    class="input-pool w-full border-gray-300 rounded text-xs text-gray-600"
                                    value="Spot foto Instagramable">
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group">
                            <span
                                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                                3 (Spotlight)</span>
                            <div class="mt-6 space-y-3">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1596120800912-74737dd3c880?q=80&w=100"
                                        class="w-12 h-12 rounded object-cover bg-gray-100">
                                    <div class="flex-1">
                                        <input type="text"
                                            class="input-pool w-full border-gray-300 rounded text-sm font-bold mb-1"
                                            value="Mini Cafe">
                                        <input type="file" class="text-xs text-gray-500 w-full">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group md:col-span-2">
                            <span
                                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                                4 (Detail/Fasilitas)</span>
                            <div class="mt-6 flex flex-col md:flex-row gap-4">
                                <div class="md:w-1/3">
                                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?q=80&w=200"
                                        class="w-full h-24 object-cover rounded bg-gray-100">
                                    <input type="file" class="text-xs text-gray-500 mt-2 w-full">
                                </div>
                                <div class="md:w-2/3 space-y-2">
                                    <input type="text"
                                        class="input-pool w-full border-gray-300 rounded text-sm font-bold"
                                        value="Fasilitas Modern & Bersih">
                                    <textarea rows="2" class="input-pool w-full border-gray-300 rounded text-xs text-gray-600">Ruang ganti premium, shower air hangat, dan locker room.</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div x-show="activeTab === 'timeline'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
                    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg md:text-xl font-bold text-gray-800">Progress Tracker</h2>
                            <p class="text-gray-500 text-xs md:text-sm">Update tahapan pembangunan secara transparan.</p>
                        </div>
                        <button @click="addStage()"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3 py-2 rounded-lg flex items-center gap-2 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Tambah Tahap
                        </button>
                    </div>

                    <div class="space-y-6">
                        <template x-for="(stage, index) in timeline" :key="index">
                            <div
                                class="border border-gray-200 rounded-xl p-5 bg-white relative transition hover:border-blue-300 shadow-sm">

                                <button @click="removeStage(index)"
                                    class="absolute top-3 right-3 text-gray-300 hover:text-red-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                                        </path>
                                    </svg>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase">Judul
                                                Tahap</label>
                                            <input type="text" x-model="stage.title"
                                                class="input-pool w-full border-b border-gray-200 focus:border-blue-500 font-bold text-gray-800 p-1 border-t-0 border-x-0 focus:ring-0">
                                        </div>
                                        <div class="flex gap-4">
                                            <div class="w-1/2">
                                                <label
                                                    class="block text-xs font-bold text-gray-500 uppercase">Periode</label>
                                                <input type="text" x-model="stage.date"
                                                    class="input-pool w-full border-b border-gray-200 focus:border-blue-500 text-sm text-gray-600 p-1 border-t-0 border-x-0 focus:ring-0">
                                            </div>
                                            <div class="w-1/2">
                                                <label
                                                    class="block text-xs font-bold text-gray-500 uppercase">Status</label>
                                                <select x-model="stage.status"
                                                    class="input-pool w-full border-gray-200 rounded text-sm p-1 bg-gray-50 focus:ring-blue-500">
                                                    <option value="done">✅ Done (Selesai)</option>
                                                    <option value="progress">🚧 On Progress</option>
                                                    <option value="planned">📅 Planned</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-xs font-bold text-gray-500 uppercase">Deskripsi</label>
                                            <textarea x-model="stage.desc" rows="2"
                                                class="input-pool w-full border-gray-200 rounded text-sm p-2 bg-gray-50 focus:ring-blue-500"></textarea>
                                        </div>
                                    </div>

                                    <div
                                        class="bg-gray-50 rounded-lg p-4 border border-dashed border-gray-300 flex flex-col justify-center">

                                        <div x-show="stage.status === 'progress'" class="space-y-4" x-transition>
                                            <div>
                                                <div class="flex justify-between mb-1">
                                                    <label class="text-xs font-bold text-blue-700">Persentase
                                                        Progres</label>
                                                    <span class="text-xs font-bold text-blue-700"
                                                        x-text="stage.percent + '%'"></span>
                                                </div>
                                                <input type="range" x-model="stage.percent" min="0"
                                                    max="99"
                                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                            </div>
                                            <div>
                                                <label class="text-xs font-bold text-gray-500 mb-2 block">Foto Progres (Max
                                                    3)</label>
                                                <div class="flex gap-2">
                                                    <div
                                                        class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs border border-gray-300">
                                                        Img 1</div>
                                                    <div
                                                        class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs border border-gray-300">
                                                        Img 2</div>
                                                    <label
                                                        class="w-16 h-16 bg-white border-2 border-dashed border-blue-300 rounded flex items-center justify-center text-blue-500 cursor-pointer hover:bg-blue-50">
                                                        <span class="text-xl">+</span>
                                                        <input type="file" class="hidden">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div x-show="stage.status === 'done'" class="text-center text-green-600"
                                            x-transition>
                                            <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-sm font-bold">Tahap Selesai 100%</p>
                                            <p class="text-xs text-gray-500">Data terkunci.</p>
                                        </div>

                                        <div x-show="stage.status === 'planned'" class="text-center text-gray-400"
                                            x-transition>
                                            <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-sm">Belum Dimulai</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

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
