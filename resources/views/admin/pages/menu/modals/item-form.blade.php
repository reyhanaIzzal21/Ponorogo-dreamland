{{-- Item Form Modal --}}
<div x-show="isItemModalOpen" class="fixed inset-0 z-80 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    x-transition.opacity @click.self="closeItemModal()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden m-4" @click.stop>

        {{-- Modal Header --}}
        <div class="bg-theme p-4 flex justify-between items-center">
            <h3 class="text-white font-bold" x-text="editingItem ? 'Edit Item' : 'Tambah Item Baru'"></h3>
            <button @click="closeItemModal()" class="text-white/80 hover:text-white text-xl">&times;</button>
        </div>

        {{-- Modal Body --}}
        <form @submit.prevent="saveItem()" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            {{-- Name (except for price-group) --}}
            <div x-show="currentCategory?.type !== 'price-group'">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Menu / Paket *</label>
                <input type="text" x-model="itemForm.name"
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                    placeholder="Contoh: Ayam Bakar">
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Harga (Rp) *</label>
                <input type="number" x-model="itemForm.price" required min="0"
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                    placeholder="Contoh: 25000">
            </div>

            {{-- Price Suffix (for package-list) --}}
            <div x-show="currentCategory?.type === 'package-list'">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Suffix Harga</label>
                <input type="text" x-model="itemForm.price_suffix"
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                    placeholder="Contoh: /pax, /porsi">
            </div>

            {{-- Description (for promo) --}}
            <div x-show="currentCategory?.type === 'grid-promo'">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Deskripsi</label>
                <textarea x-model="itemForm.description" rows="2"
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                    placeholder="Contoh: 1 Nasi + 1 Ayam + 1 Es Teh"></textarea>
            </div>

            {{-- Image Upload (for photo types) --}}
            <div x-show="['grid-photo', 'grid-promo', 'grid-photo-small'].includes(currentCategory?.type)">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Foto Menu</label>

                {{-- Preview --}}
                <div x-show="imagePreview || itemForm.image_path" class="mb-2">
                    <img :src="imagePreview || itemForm.image_path" class="w-full h-32 object-cover rounded-lg">
                </div>

                <div
                    class="border-2 border-dashed border-gray-300 rounded-lg p-4 flex flex-col items-center justify-center text-gray-400 hover:border-theme hover:bg-theme-light transition cursor-pointer relative">
                    <input type="file" accept="image/*" @change="handleImageUpload($event)"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="text-xs">Klik untuk upload foto</span>
                </div>
            </div>

            {{-- Promo Settings --}}
            <div x-show="currentCategory?.type === 'grid-promo'" class="space-y-2">
                <div class="flex items-center gap-2">
                    <input type="checkbox" x-model="itemForm.is_promo" id="item-is-promo"
                        class="rounded border-gray-300 text-theme focus:ring-theme">
                    <label for="item-is-promo" class="text-sm text-gray-700">Tandai sebagai Promo</label>
                </div>
                <div x-show="itemForm.is_promo">
                    <input type="text" x-model="itemForm.promo_badge"
                        class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                        placeholder="Badge: BEST DEAL, NEW, PROMO">
                </div>
            </div>

            {{-- Package Contents (for package-list) --}}
            <div x-show="currentCategory?.type === 'package-list'">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Daftar Isi Paket</label>
                <p class="text-[10px] text-gray-400 mb-2">Tekan Enter untuk menambah item.</p>
                <div
                    class="border border-gray-300 rounded-lg p-2 flex flex-wrap gap-2 focus-within:ring-1 focus-within:ring-theme focus-within:border-theme bg-white min-h-[80px]">
                    <template x-for="(content, index) in itemForm.package_contents" :key="index">
                        <span class="tag-item text-xs px-2 py-1 rounded flex items-center gap-1">
                            <span x-text="content"></span>
                            <button type="button" @click="removePackageContent(index)">&times;</button>
                        </span>
                    </template>
                    <input type="text" x-ref="packageContentInput"
                        class="flex-1 text-sm border-none focus:ring-0 p-1 min-w-[100px]" placeholder="Ketik item..."
                        @keydown.enter.prevent="addPackageContent($event.target.value); $event.target.value = ''">
                </div>
            </div>

            {{-- Is Active --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" x-model="itemForm.is_active" id="item-is-active"
                    class="rounded border-gray-300 text-theme focus:ring-theme">
                <label for="item-is-active" class="text-sm text-gray-700">Aktif (tampilkan di menu)</label>
            </div>

            {{-- Error Message --}}
            <div x-show="formError" class="text-red-500 text-sm" x-text="formError"></div>

            {{-- Modal Footer --}}
            <div class="flex justify-end gap-2 pt-4 border-t">
                <button type="button" @click="closeItemModal()"
                    class="px-4 py-2 text-gray-600 text-sm font-bold hover:bg-gray-100 rounded-lg transition">
                    Batal
                </button>
                <button type="submit" :disabled="isSubmitting"
                    class="px-4 py-2 bg-theme text-white text-sm font-bold rounded-lg hover:bg-red-800 shadow-md transition disabled:opacity-50">
                    <span x-show="!isSubmitting" x-text="editingItem ? 'Update' : 'Simpan'"></span>
                    <span x-show="isSubmitting">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
