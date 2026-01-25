{{-- Price Group Form Modal --}}
<div x-show="isPriceGroupModalOpen"
    class="fixed inset-0 z-80 flex items-center justify-center bg-black/50 backdrop-blur-sm" x-transition.opacity
    @click.self="closePriceGroupModal()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden m-4" @click.stop>

        {{-- Modal Header --}}
        <div class="bg-gray-800 p-4 flex justify-between items-center">
            <h3 class="text-yellow-400 font-bold"
                x-text="editingPriceGroup ? 'Edit Price Group' : 'Tambah Price Group Baru'"></h3>
            <button @click="closePriceGroupModal()" class="text-white/80 hover:text-white text-xl">&times;</button>
        </div>

        {{-- Modal Body --}}
        <form @submit.prevent="savePriceGroup()" class="p-6 space-y-4">
            {{-- Price --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Harga (Rp) *</label>
                <input type="number" x-model="priceGroupForm.price" required min="0"
                    class="w-full border-gray-300 rounded-lg focus:ring-theme focus:border-theme text-sm p-2.5"
                    placeholder="Contoh: 2500">
                <p class="text-xs text-gray-400 mt-1">Semua item dalam group ini akan memiliki harga yang sama.</p>
            </div>

            {{-- Items (Optional during creation) --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Daftar Item (Opsional)</label>
                <p class="text-[10px] text-gray-400 mb-2">Tekan Enter untuk menambah item. Bisa ditambahkan nanti.</p>
                <div
                    class="border border-gray-300 rounded-lg p-2 flex flex-wrap gap-2 focus-within:ring-1 focus-within:ring-theme focus-within:border-theme bg-white min-h-[80px]">
                    <template x-for="(item, index) in priceGroupForm.items" :key="index">
                        <span class="tag-item text-xs px-2 py-1 rounded flex items-center gap-1">
                            <span x-text="item"></span>
                            <button type="button" @click="removePriceGroupFormItem(index)">&times;</button>
                        </span>
                    </template>
                    <input type="text" x-ref="priceGroupItemInput"
                        class="flex-1 text-sm border-none focus:ring-0 p-1 min-w-[100px]" placeholder="Ketik item..."
                        @keydown.enter.prevent="addPriceGroupFormItem($event.target.value); $event.target.value = ''">
                </div>
            </div>

            {{-- Is Active --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" x-model="priceGroupForm.is_active" id="pg-is-active"
                    class="rounded border-gray-300 text-theme focus:ring-theme">
                <label for="pg-is-active" class="text-sm text-gray-700">Aktif (tampilkan di menu)</label>
            </div>

            {{-- Error Message --}}
            <div x-show="formError" class="text-red-500 text-sm" x-text="formError"></div>

            {{-- Modal Footer --}}
            <div class="flex justify-end gap-2 pt-4 border-t">
                <button type="button" @click="closePriceGroupModal()"
                    class="px-4 py-2 text-gray-600 text-sm font-bold hover:bg-gray-100 rounded-lg transition">
                    Batal
                </button>
                <button type="submit" :disabled="isSubmitting"
                    class="px-4 py-2 bg-gray-800 text-yellow-400 text-sm font-bold rounded-lg hover:bg-gray-700 shadow-md transition disabled:opacity-50">
                    <span x-show="!isSubmitting" x-text="editingPriceGroup ? 'Update' : 'Simpan'"></span>
                    <span x-show="isSubmitting">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
