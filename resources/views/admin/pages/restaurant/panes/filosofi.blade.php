<div x-show="activeTab === 'filosofi'" class="p-6 md:p-8 space-y-8" x-transition.opacity>
    <div class="flex justify-between items-center border-b border-gray-100 pb-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Filosofi Kami</h2>
            <p class="text-xs text-gray-400">Cerita di balik nama dan rasa Dam Cokro.</p>
        </div>
        <button @click="submitForm('filosofiForm', '{{ route('admin.restaurant.filosofi.update') }}')"
            :disabled="loading"
            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 text-sm font-bold shadow transition disabled:opacity-50">
            <span x-show="!loading">💾 Simpan</span>
            <span x-show="loading">Menyimpan...</span>
        </button>
    </div>

    <form id="filosofiForm">
        <div class="bg-parchment p-6 rounded-2xl border border-golden-cokro">
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-primary uppercase mb-2">Judul Filosofi</label>
                    <input type="text" name="title"
                        class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3"
                        value="{{ $filosofiSection->title ?? 'Lebih dari Sekadar Tempat Makan' }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase mb-2">Isi Cerita</label>
                    <textarea name="description"
                        class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3 h-48 font-light leading-relaxed">{{ $filosofiSection->description ??
                            '"Dam Cokro" bukan hanya nama, tapi sebuah janji. Diambil dari semangat menjaga aliran tradisi agar tetap jernih dan menghidupi.
                        
                        Kami bekerja sama langsung dengan petani lokal Ponorogo untuk mendapatkan rempah terbaik. Proses memasak kami masih mempertahankan teknik \'slow cooking\'.' }}</textarea>
                </div>
            </div>
        </div>
    </form>
</div>
