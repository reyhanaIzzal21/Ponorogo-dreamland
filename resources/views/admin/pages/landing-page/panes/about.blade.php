<div x-show="activeTab === 'about'" class="space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-xl font-bold text-gray-800">Edit Tentang Kami</h2>
        <p class="text-gray-500 text-sm">Ceritakan visi dan sejarah Ponorogo Dreamland.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Section</label>
                <input type="text" class="w-full border-gray-300 rounded-lg shadow-sm"
                    value="Mewujudkan Mimpi di Tanah Ponorogo">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Lengkap</label>
                <textarea rows="8" class="w-full border-gray-300 rounded-lg shadow-sm">Ponorogo Dreamland lahir dari sebuah mimpi sederhana: menyediakan satu tempat di mana tradisi lokal dapat berpadu harmonis dengan kenyamanan modern.

Kami percaya bahwa momen terbaik diciptakan melalui makanan yang lezat, suasana yang hangat, dan tempat yang nyaman.</textarea>
            </div>
        </div>

        <div class="space-y-4">
            <label class="block text-sm font-bold text-gray-700">Foto Ilustrasi (Max 2)</label>

            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                <img src="https://images.unsplash.com/photo-1605218427368-35b80a37e296?q=80&w=200"
                    class="w-20 h-20 object-cover rounded-md bg-gray-200">
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-700 mb-1">Foto Kiri</p>
                    <input type="file"
                        class="text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
            </div>

            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                <img src="https://images.unsplash.com/photo-1561582806-398d287178d6?q=80&w=200"
                    class="w-20 h-20 object-cover rounded-md bg-gray-200">
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-700 mb-1">Foto Kanan</p>
                    <input type="file"
                        class="text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
            </div>
        </div>
    </div>
</div>
