{{-- Grid Layout for photo-based items (grid-promo, grid-photo, grid-photo-small) --}}
<div class="grid gap-4"
    :class="{
        'grid-cols-1 md:grid-cols-3': currentCategory?.type === 'grid-promo',
        'grid-cols-1 md:grid-cols-3 lg:grid-cols-4': currentCategory?.type === 'grid-photo',
        'grid-cols-2 md:grid-cols-4 lg:grid-cols-6': currentCategory?.type === 'grid-photo-small'
    }">
    <template x-for="item in categoryItems" :key="item.id">
        <div
            class="bg-white rounded-xl border border-gray-200 overflow-hidden group hover:shadow-md transition relative">
            {{-- Image Section --}}
            <div class="relative overflow-hidden" :class="currentCategory?.type === 'grid-photo-small' ? 'h-24' : 'h-32'">
                <img :src="getImageUrl(item)" class="w-full h-full object-cover" :alt="item.name"
                    onerror="this.src='/images/placeholder-food.jpg'">

                {{-- Promo Badge --}}
                <div x-show="item.is_promo && item.promo_badge"
                    class="absolute top-2 right-2 bg-theme text-white text-xs font-bold px-2 py-0.5 rounded-full z-10"
                    x-text="item.promo_badge">
                </div>

                {{-- Hover Actions --}}
                <div
                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                    <button @click="editItem(item)"
                        class="p-1.5 bg-white rounded-full text-gray-800 hover:bg-gray-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </button>
                    <button @click="confirmDelete(item)"
                        class="p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Content Section --}}
            <div class="p-3">
                <div class="flex justify-between items-start mb-1">
                    <h3 class="font-bold text-gray-800 text-sm line-clamp-1" x-text="item.name"></h3>
                </div>
                <p x-show="item.description && currentCategory?.type === 'grid-promo'"
                    class="text-xs text-gray-500 mb-2 line-clamp-2" x-text="item.description"></p>
                <p class="text-xs text-theme font-bold" x-text="formatPrice(item.price)"></p>
            </div>
        </div>
    </template>
</div>
