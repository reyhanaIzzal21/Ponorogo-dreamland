<div x-show="activeTab === 'hero'" class="space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-xl font-bold text-gray-800">Edit Hero Section</h2>
        <p class="text-gray-500 text-sm">Bagian paling atas yang pertama kali dilihat pengunjung.</p>
    </div>

    <div class="grid gap-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Main Headline</label>
            <input type="text"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500"
                value="Ponorogo Dreamland: Destinasi Terpadu untuk Kuliner, Tradisi, dan Rekreasi.">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Sub Headline</label>
            <textarea rows="3"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">Nikmati pengalaman tak terlupakan bersama keluarga di pusat kenyamanan dan kehangatan kota Ponorogo.</textarea>
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-700 mb-3">Carousel Images</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="group relative rounded-lg overflow-hidden border border-gray-200">
                <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=400"
                    class="w-full h-32 object-cover">
                <div
                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                    <button type="button" class="text-red-400 hover:text-red-600"><svg class="w-6 h-6"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z" />
                        </svg></button>
                </div>
            </div>
            <div class="group relative rounded-lg overflow-hidden border border-gray-200">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=400"
                    class="w-full h-32 object-cover">
                <div
                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                    <button type="button" class="text-red-400 hover:text-red-600"><svg class="w-6 h-6"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z" />
                        </svg></button>
                </div>
            </div>
            <label
                class="cursor-pointer file-zone rounded-lg flex flex-col items-center justify-center h-32 bg-gray-50 text-gray-400 hover:text-green-600">
                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-xs font-bold">Upload Baru</span>
                <input type="file" class="hidden" multiple>
            </label>
        </div>
    </div>
</div>
