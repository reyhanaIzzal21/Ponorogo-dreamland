{{-- Package List Layout for prasmanan/nasi box items --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <template x-for="item in categoryItems" :key="item.id">
        <div class="bg-white rounded-xl border border-gray-200 p-4 relative group hover:border-theme transition">
            {{-- Header --}}
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg" x-text="item.name"></h3>
                    <p class="text-theme font-bold text-sm" x-text="formatPrice(item.price) + (item.price_suffix || '')">
                    </p>
                </div>
                {{-- Actions --}}
                <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
                    <button @click="editItem(item)" class="text-gray-400 hover:text-gray-600 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </button>
                    <button @click="confirmDelete(item)" class="text-red-400 hover:text-red-600 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Package Contents --}}
            <div class="bg-gray-50 rounded p-2 text-xs text-gray-600 max-h-32 overflow-y-auto">
                <ul class="list-disc pl-4 space-y-1">
                    <template x-for="content in item.package_contents" :key="content.id">
                        <li x-text="content.content_name"></li>
                    </template>
                </ul>
                <p x-show="!item.package_contents || item.package_contents.length === 0"
                    class="text-gray-400 italic text-center py-2">
                    Belum ada isi paket
                </p>
            </div>
        </div>
    </template>
</div>
