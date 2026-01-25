<div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Edit Hero Section</h2>
        <p class="text-gray-500 text-xs md:text-sm">Bagian paling atas website.</p>
    </div>

    <div class="grid gap-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Main Headline</label>
            <input type="text"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-3"
                value="Ponorogo Dreamland: Destinasi Terpadu untuk">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Main Headline <span class="text-yellow-500">(Akan tampil berwarna kuning)</span></label>
            <input type="text"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-3"
                value="Kuliner, Tradisi, dan Rekreasi.">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Sub Headline</label>
            <textarea rows="3"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-3">Nikmati pengalaman tak terlupakan bersama keluarga di pusat kenyamanan dan kehangatan kota Ponorogo.</textarea>
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-700 mb-3">Carousel Images</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
            <div class="group relative rounded-lg overflow-hidden border border-gray-200 aspect-video">
                <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=400"
                    class="w-full h-full object-cover">
                <button
                    class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded shadow-md opacity-100 md:opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="group relative rounded-lg overflow-hidden border border-gray-200 aspect-video">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=400"
                    class="w-full h-full object-cover">
                <button
                    class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded shadow-md opacity-100 md:opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <label
                class="cursor-pointer file-zone rounded-lg flex flex-col items-center justify-center aspect-video bg-gray-50 text-gray-400 hover:text-green-600">
                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-xs font-bold">Upload</span>
                <input type="file" class="hidden" multiple>
            </label>
        </div>
    </div>
</div>
