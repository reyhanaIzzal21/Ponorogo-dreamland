<div class="w-full lg:w-64 shrink-0 z-10 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
    <nav
        class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

        <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
            <span class="text-lg">🖼️</span> Hero Section
        </button>

        <button @click="activeTab = 'menu'" :class="activeTab === 'menu' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
            <span class="text-lg">🍲</span> Best Seller
        </button>

        <button @click="activeTab = 'filosofi'" :class="activeTab === 'filosofi' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
            <span class="text-lg">📜</span> Filosofi
        </button>

        <button @click="activeTab = 'gallery'" :class="activeTab === 'gallery' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0">
            <span class="text-lg">📸</span> Galeri & Sosmed
        </button>
    </nav>
</div>
