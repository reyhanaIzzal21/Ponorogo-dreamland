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
                <input type="text" class="input-pool w-full border-gray-300 rounded text-xs text-gray-600"
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
                        <input type="text" class="input-pool w-full border-gray-300 rounded text-sm font-bold mb-1"
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
                    <input type="text" class="input-pool w-full border-gray-300 rounded text-sm font-bold"
                        value="Fasilitas Modern & Bersih">
                    <textarea rows="2" class="input-pool w-full border-gray-300 rounded text-xs text-gray-600">Ruang ganti premium, shower air hangat, dan locker room.</textarea>
                </div>
            </div>
        </div>

    </div>
</div>
