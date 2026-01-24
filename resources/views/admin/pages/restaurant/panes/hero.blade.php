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
                class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-heritage-red transition cursor-pointer">
                <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=800"
                    class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-500">
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
