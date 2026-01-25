{{-- Category Form Modal --}}
<div x-show="isCategoryModalOpen" class="fixed inset-0 z-80 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    x-transition.opacity @click.self="closeCategoryModal()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden m-4" @click.stop>

        {{-- Modal Header --}}
        <div class="bg-theme p-4 flex justify-between items-center">
            <h3 class="text-white font-bold" x-text="editingCategory ? 'Edit Kategori' : 'Tambah Kategori Baru'"></h3>
            <button @click="closeCategoryModal()" class="text-white/80 hover:text-white text-xl">&times;</button>
        </div>

        {{-- Modal Body --}}
        <form @submit.prevent="saveCategory()" class="p-6 space-y-4">
            {{-- Name --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Kategori *</label>
                <input type="text" x-model="categoryForm.name" required
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                    placeholder="Contoh: Combo Nikmat">
                <p class="text-xs text-gray-400 mt-1">Slug akan di-generate otomatis dari nama.</p>
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipe Layout *</label>
                <select x-model="categoryForm.type" required
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5">
                    <template x-for="(label, value) in categoryTypes" :key="value">
                        <option :value="value" x-text="label"></option>
                    </template>
                </select>
            </div>

            {{-- Icon --}}
            {{-- <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Icon (opsional)</label>
                <input type="text" x-model="categoryForm.icon"
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                    placeholder="Contoh: 🍱 atau nama icon">
            </div> --}}

            {{-- Is Active --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" x-model="categoryForm.is_active" id="cat-is-active"
                    class="rounded border-gray-300 text-theme focus:ring-theme">
                <label for="cat-is-active" class="text-sm text-gray-700">Aktif (tampilkan di halaman menu)</label>
            </div>

            {{-- Error Message --}}
            <div x-show="formError" class="text-red-500 text-sm" x-text="formError"></div>

            {{-- Modal Footer --}}
            <div class="flex justify-end gap-2 pt-4 border-t">
                <button type="button" @click="closeCategoryModal()"
                    class="px-4 py-2 text-gray-600 text-sm font-bold hover:bg-gray-100 rounded-lg transition">
                    Batal
                </button>
                <button type="submit" :disabled="isSubmitting"
                    class="px-4 py-2 bg-theme text-white text-sm font-bold rounded-lg hover:bg-red-800 shadow-md transition disabled:opacity-50">
                    <span x-show="!isSubmitting" x-text="editingCategory ? 'Update' : 'Simpan'"></span>
                    <span x-show="isSubmitting">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
