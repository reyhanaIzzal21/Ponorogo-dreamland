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
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                        </path>
                    </svg>
                </div>
            </div>
            <div
                class="relative group aspect-square rounded-xl overflow-hidden shadow-sm bg-gray-100 border-2 border-dashed border-gray-300 hover:border-heritage-red transition cursor-pointer flex items-center justify-center">
                <img src="https://images.unsplash.com/photo-1592861956120-e524fc739696?q=80&w=300"
                    class="w-full h-full object-cover">
                <div
                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <input type="text" class="input-resto w-full rounded-r-lg border-gray-300 shadow-sm p-3"
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
