<div x-show="activeTab === 'specs'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
        <div>
            <h2 class="text-lg md:text-xl font-bold text-gray-800">Spesifikasi Ruang</h2>
            <p class="text-gray-500 text-xs md:text-sm">Data teknis venue (Maksimal 4).</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-gray-600">Slot Terpakai:</span>
            <span class="px-2 py-1 rounded bg-orange-100 text-earth font-bold text-xs"
                x-text="specs.length + '/4'"></span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-xl">
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Section Title</label>
            <input type="text" x-model="specsTitle"
                class="input-pendopo w-full bg-white border-gray-200 rounded p-2 text-sm"
                placeholder="Spesifikasi Venue">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Sub-Title</label>
            <input type="text" x-model="specsSubtitle"
                class="input-pendopo w-full bg-white border-gray-200 rounded p-2 text-sm"
                placeholder="Detail teknis untuk kebutuhan Anda">
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
                            class="input-pendopo w-full border-b border-gray-200 focus:border-earth text-sm font-bold text-gray-800 p-0 pb-1 border-t-0 border-x-0 focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold text-gray-400">Nilai /
                            Detail</label>
                        <input type="text" x-model="item.desc"
                            class="input-pendopo w-full border-b border-gray-200 focus:border-earth text-sm text-gray-600 p-0 pb-1 border-t-0 border-x-0 focus:ring-0">
                    </div>
                </div>
            </div>
        </template>

        <button x-show="specs.length < 4" @click="addSpec()"
            class="border-2 border-dashed border-gray-300 rounded-xl p-4 flex flex-col items-center justify-center text-gray-400 hover:text-earth hover:border-earth hover:bg-orange-50 transition h-full min-h-[120px]">
            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                </path>
            </svg>
            <span class="text-xs font-bold">Tambah Data</span>
        </button>
    </div>
</div>
