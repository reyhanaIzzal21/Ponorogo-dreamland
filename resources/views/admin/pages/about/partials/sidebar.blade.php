<div class="w-full lg:w-64 flex-shrink-0 z-20 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
    <nav
        class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

        <button type="button" @click="setTab('hero')" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
            <span class="text-lg">✒️</span> Hero Narrative
        </button>

        <button type="button" @click="setTab('journey')" :class="activeTab === 'journey' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
            <span class="text-lg">👣</span> Journey (Zig-Zag)
        </button>

        <button type="button" @click="setTab('values')"
            :class="activeTab === 'values' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
            <span class="text-lg">💎</span> Nilai Inti
        </button>

        <button type="button" @click="setTab('extra')"
            :class="activeTab === 'extra' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 flex-shrink-0">
            <span class="text-lg">📊</span> Statistik & Quote
        </button>
    </nav>
</div>
