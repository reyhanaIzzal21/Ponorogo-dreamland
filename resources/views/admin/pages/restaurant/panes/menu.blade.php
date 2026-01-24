<div x-show="activeTab === 'menu'" class="p-6 md:p-8 space-y-8" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4">
        <h2 class="text-xl font-bold text-gray-800">Menu Best Seller</h2>
        <p class="text-xs text-gray-400">Pilih 3 menu dari database untuk ditampilkan di halaman depan.</p>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold text-heritage-red uppercase mb-2">Slot 1 (Highlight
                        Utama)</label>
                    <select x-model="slot1" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                        <template x-for="menu in menus" :key="menu.id">
                            <option :value="menu.id" x-text="menu.name"></option>
                        </template>
                    </select>
                </div>
                <div
                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                    <img :src="getMenu(slot1).image" class="w-16 h-16 rounded-md object-cover bg-gray-200">
                    <div>
                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot1).name"></p>
                        <p class="text-xs text-heritage-red font-bold" x-text="getMenu(slot1).price"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Slot 2</label>
                    <select x-model="slot2" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                        <template x-for="menu in menus" :key="menu.id">
                            <option :value="menu.id" x-text="menu.name"></option>
                        </template>
                    </select>
                </div>
                <div
                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                    <img :src="getMenu(slot2).image" class="w-16 h-16 rounded-md object-cover bg-gray-200">
                    <div>
                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot2).name"></p>
                        <p class="text-xs text-heritage-red font-bold" x-text="getMenu(slot2).price"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Slot 3</label>
                    <select x-model="slot3" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                        <template x-for="menu in menus" :key="menu.id">
                            <option :value="menu.id" x-text="menu.name"></option>
                        </template>
                    </select>
                </div>
                <div
                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                    <img :src="getMenu(slot3).image" class="w-16 h-16 rounded-md object-cover bg-gray-200">
                    <div>
                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot3).name"></p>
                        <p class="text-xs text-heritage-red font-bold" x-text="getMenu(slot3).price"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
