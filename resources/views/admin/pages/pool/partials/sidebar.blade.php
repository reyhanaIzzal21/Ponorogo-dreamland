<div class="w-full lg:w-64 shrink-0 z-20 sticky top-0 lg:static bg-gray-50 pt-2 lg:pt-0">
    <nav
        class="flex lg:flex-col gap-2 overflow-x-auto hide-scroll pb-2 lg:pb-0 bg-white lg:bg-transparent p-2 lg:p-0 rounded-xl shadow-sm lg:shadow-none border border-gray-100 lg:border-none">

        <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 shrink-0">
            <span class="text-lg">⏱️</span> Hero & Countdown
        </button>

        <button @click="activeTab = 'sneak'" :class="activeTab === 'sneak' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 shrink-0">
            <span class="text-lg">👀</span> Sneak Peek (Bento)
        </button>

        <button @click="activeTab = 'timeline'" :class="activeTab === 'timeline' ? 'tab-active' : 'tab-inactive'"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-b-2 lg:border-b-0 lg:border-l-4 transition-all whitespace-nowrap min-w-[140px] lg:min-w-0 shrink-0">
            <span class="text-lg">🏗️</span> Project Timeline
        </button>

    </nav>
</div>
