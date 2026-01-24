<div x-show="activeTab === 'about'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Edit Tentang Kami</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Section</label>
                <input type="text" class="w-full border-gray-300 rounded-lg shadow-sm p-3"
                    value="Mewujudkan Mimpi di Tanah Ponorogo">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Lengkap</label>
                <textarea rows="6" class="w-full border-gray-300 rounded-lg shadow-sm p-3">Ponorogo Dreamland lahir dari sebuah mimpi sederhana...</textarea>
            </div>
        </div>

        <div class="space-y-4">
            <label class="block text-sm font-bold text-gray-700">Foto Ilustrasi (Max 2)</label>

            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                <img src="https://images.unsplash.com/photo-1605218427368-35b80a37e296?q=80&w=200"
                    class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md bg-gray-200">
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs md:text-sm font-bold text-gray-700 mb-1">Foto Kiri</p>
                    <input type="file" class="text-xs w-full text-gray-500">
                </div>
            </div>

            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                <img src="https://images.unsplash.com/photo-1561582806-398d287178d6?q=80&w=200"
                    class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md bg-gray-200">
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs md:text-sm font-bold text-gray-700 mb-1">Foto Kanan</p>
                    <input type="file" class="text-xs w-full text-gray-500">
                </div>
            </div>
        </div>
    </div>
</div>
