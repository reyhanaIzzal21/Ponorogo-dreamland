<div class="w-full md:w-64 bg-gray-50 border-r border-gray-200 p-4 shrink-0">
    <nav class="space-y-1">
        <button @click="activeTab = 'hero'"
            :class="{ 'bg-green-100 text-green-800 border-green-600': activeTab === 'hero', 'text-gray-600 hover:bg-gray-100 border-transparent': activeTab !== 'hero' }"
            class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-l-4 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
            Hero Section
        </button>

        <button @click="activeTab = 'about'"
            :class="{ 'bg-green-100 text-green-800 border-green-600': activeTab === 'about', 'text-gray-600 hover:bg-gray-100 border-transparent': activeTab !== 'about' }"
            class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-l-4 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Tentang Kami
        </button>

        <button @click="activeTab = 'why'"
            :class="{ 'bg-green-100 text-green-800 border-green-600': activeTab === 'why', 'text-gray-600 hover:bg-gray-100 border-transparent': activeTab !== 'why' }"
            class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-l-4 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Why Choose Us
        </button>

        <button @click="activeTab = 'moment'"
            :class="{ 'bg-green-100 text-green-800 border-green-600': activeTab === 'moment', 'text-gray-600 hover:bg-gray-100 border-transparent': activeTab !== 'moment' }"
            class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg border-l-4 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
            Momen Spesial
        </button>
    </nav>
</div>
