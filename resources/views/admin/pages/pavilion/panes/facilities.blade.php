<div x-show="activeTab === 'facilities'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Fasilitas Inklusif</h2>
        <p class="text-gray-500 text-xs md:text-sm">Item yang didapatkan penyewa.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Left: Section Info -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Utama</label>
                <input type="text" x-model="facilitiesTitle"
                    class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3"
                    placeholder="Segala yang Anda Butuhkan">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Utama</label>
                <textarea rows="3" x-model="facilitiesDescription"
                    class="input-pendopo w-full border-gray-300 rounded-lg shadow-sm p-3"
                    placeholder="Kami memahami bahwa kelancaran acara bergantung pada fasilitas pendukung."></textarea>
            </div>
        </div>

        <!-- Right: Section Image -->
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Section Fasilitas</label>
            <div
                class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-earth transition cursor-pointer">
                <img :src="facilitiesImage ||
                    'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=900&auto=format&fit=crop'"
                    class="w-full h-full object-cover opacity-90">
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition">
                    <span class="text-white text-xs font-bold bg-black/50 px-3 py-1 rounded-full">Ganti Foto</span>
                </div>
                <input type="file" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*"
                    @change="uploadFacilitiesImage($event)">
            </div>
            <p class="text-xs text-gray-400 mt-2">Gambar yang ditampilkan di sebelah kiri daftar fasilitas pada halaman
                user.</p>
        </div>
    </div>

    <h3 class="font-bold text-gray-700 border-b border-gray-100 pb-2 mb-4">Daftar Fasilitas</h3>

    <div class="space-y-4">
        <template x-for="(fac, index) in facilities" :key="index">
            <div
                class="flex flex-col md:flex-row gap-4 p-4 border border-gray-200 rounded-xl bg-gray-50 items-start md:items-center group">
                <div
                    class="w-12 h-12 bg-white rounded-lg border border-gray-200 flex items-center justify-center text-2xl shrink-0 cursor-pointer hover:border-earth">
                    <input type="text" x-model="fac.icon"
                        class="w-full h-full text-center bg-transparent border-0 focus:ring-0 text-2xl" maxlength="2">
                </div>

                <div class="flex-1 w-full space-y-2 md:space-y-0 md:grid md:grid-cols-2 md:gap-4">
                    <input type="text" x-model="fac.title"
                        class="input-pendopo w-full border-gray-300 rounded bg-white text-sm font-bold"
                        placeholder="Nama Fasilitas">
                    <input type="text" x-model="fac.desc"
                        class="input-pendopo w-full border-gray-300 rounded bg-white text-sm text-gray-600"
                        placeholder="Deskripsi Singkat">
                </div>

                <button @click="removeFacility(index)"
                    class="text-red-400 hover:text-red-600 p-2 md:self-center self-end">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                        </path>
                    </svg>
                </button>
            </div>
        </template>

        <button @click="addFacility()"
            class="w-full py-3 border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:border-earth hover:text-earth hover:bg-orange-50 transition flex items-center justify-center gap-2 font-bold text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                </path>
            </svg>
            Tambah Fasilitas
        </button>
    </div>
</div>
