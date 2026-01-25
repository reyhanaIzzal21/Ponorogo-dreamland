{{-- Price Group Layout for snack items --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <template x-for="group in priceGroups" :key="group.id">
        <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-4 relative group">
            {{-- Price Badge --}}
            <div class="absolute -top-3 left-4 bg-gray-800 text-yellow-400 px-3 py-1 rounded text-xs font-bold"
                x-text="'Serba ' + formatPrice(group.price)">
            </div>

            {{-- Actions --}}
            <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                <button @click="editPriceGroup(group)" class="text-gray-400 hover:text-gray-600 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                        </path>
                    </svg>
                </button>
                <button @click="confirmDeletePriceGroup(group)" class="text-red-400 hover:text-red-600 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                        </path>
                    </svg>
                </button>
            </div>

            {{-- Items List --}}
            <div class="mt-4 space-y-2">
                <template x-for="item in group.items" :key="item.id">
                    <div class="flex justify-between items-center text-sm border-b border-gray-100 pb-1 last:border-0">
                        <span class="text-gray-700" x-text="item.item_name"></span>
                        <button @click="removePriceGroupItem(item.id)"
                            class="text-red-300 hover:text-red-500 text-xs">×</button>
                    </div>
                </template>

                {{-- Empty State --}}
                <p x-show="!group.items || group.items.length === 0"
                    class="text-gray-400 italic text-center py-2 text-xs">
                    Belum ada item
                </p>

                {{-- Add New Item Input --}}
                <div class="mt-2 flex gap-2">
                    <input type="text" :id="'new-item-' + group.id" placeholder="+ Tambah Snack"
                        class="w-full text-xs border-gray-200 rounded focus:ring-theme focus:border-theme"
                        @keydown.enter="addPriceGroupItem(group.id, $event.target.value); $event.target.value = ''">
                </div>
            </div>
        </div>
    </template>

    {{-- Add New Price Group Button --}}
    <button @click="openPriceGroupModal()"
        class="border-2 border-dashed border-gray-300 rounded-xl p-8 flex flex-col items-center justify-center text-gray-400 hover:border-theme hover:text-theme transition min-h-[200px]">
        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span class="text-sm font-bold">Tambah Price Group</span>
    </button>
</div>
