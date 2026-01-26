<div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Hero Section</h2>
        <p class="text-gray-500 text-xs md:text-sm">Tampilan utama halaman Pendopo.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Main Title</label>
                <input type="text" x-model="hero.title"
                    class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3 font-serif"
                    placeholder="Ruang Elegan untuk">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Main Title <span class="text-yellow-500">(Akan
                        tampil berwarna kuning)</span></label>
                <input type="text" x-model="hero.highlightedTitle"
                    class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3 font-serif"
                    placeholder="Momen Istimewa Anda">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Sub Title / Deskripsi</label>
                <textarea rows="4" x-model="hero.description"
                    class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3" placeholder="Deskripsi singkat..."></textarea>
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Background Image</label>
            <div
                class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-earth transition cursor-pointer">
                <img :src="hero.backgroundImage || 'https://via.placeholder.com/600x400?text=No+Image'"
                    class="w-full h-full object-cover opacity-90">
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition">
                    <span class="text-white text-xs font-bold bg-black/50 px-3 py-1 rounded-full">Ganti
                        Foto</span>
                </div>
                <input type="file" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*"
                    @change="uploadHeroBackground($event)">
            </div>
        </div>
    </div>
</div>
