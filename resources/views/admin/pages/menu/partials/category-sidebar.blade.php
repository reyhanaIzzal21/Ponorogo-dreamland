{{-- Category Sidebar Partial --}}
<div class="w-full lg:w-64 flex-shrink-0 z-20 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
    <button @click="openCategoryModal()"
        class="w-full mb-4 py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 text-xs font-bold hover:border-theme hover:text-theme transition flex items-center justify-center gap-2">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Kategori Baru
    </button>

    <nav class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0">
        <template x-for="cat in categories" :key="cat.id">
            <button @click="setActiveCategory(cat.id)"
                :class="activeCatId === cat.id ? 'bg-theme-light text-theme border-l-4 border-theme' :
                    'text-gray-600 hover:bg-white border-l-4 border-transparent'"
                class="flex items-center justify-between px-4 py-3 text-sm font-medium rounded-r-lg transition-all whitespace-nowrap min-w-[160px] lg:min-w-0 flex-shrink-0 bg-white lg:bg-transparent shadow-sm lg:shadow-none mr-2 lg:mr-0">
                <span x-text="cat.name"></span>
                <span class="text-[10px] px-1.5 py-0.5 rounded bg-gray-200 text-gray-500 ml-2"
                    x-text="getTypeLabel(cat.type)"></span>
            </button>
        </template>
    </nav>
</div>
