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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>
