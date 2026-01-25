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

                <button @click="removeStage(index)" class="absolute top-3 right-3 text-gray-300 hover:text-red-500">
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
                                <label class="block text-xs font-bold text-gray-500 uppercase">Periode</label>
                                <input type="text" x-model="stage.date"
                                    class="input-pool w-full border-b border-gray-200 focus:border-blue-500 text-sm text-gray-600 p-1 border-t-0 border-x-0 focus:ring-0">
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-bold text-gray-500 uppercase">Status</label>
                                <select x-model="stage.status"
                                    class="input-pool w-full border-gray-200 rounded text-sm p-1 bg-gray-50 focus:ring-blue-500">
                                    <option value="done">✅ Done (Selesai)</option>
                                    <option value="progress">🚧 On Progress</option>
                                    <option value="planned">📅 Planned</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Deskripsi</label>
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
                                    <span class="text-xs font-bold text-blue-700" x-text="stage.percent + '%'"></span>
                                </div>
                                <input type="range" x-model="stage.percent" min="0" max="99"
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

                        <div x-show="stage.status === 'done'" class="text-center text-green-600" x-transition>
                            <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-bold">Tahap Selesai 100%</p>
                            <p class="text-xs text-gray-500">Data terkunci.</p>
                        </div>

                        <div x-show="stage.status === 'planned'" class="text-center text-gray-400" x-transition>
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
