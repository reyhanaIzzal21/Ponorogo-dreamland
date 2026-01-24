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
                        <button @click="removeFlexibility(index)" class="text-red-400 hover:text-red-500"><svg
                                class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            class="aspect-square border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center text-gray-400 hover:text-earth hover:border-earth hover:bg-orange-50 transition">
            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
            <span class="text-xs font-bold text-center">Upload<br>Layout Baru</span>
        </button>
    </div>
</div>
