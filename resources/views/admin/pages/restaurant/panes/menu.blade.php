<div x-show="activeTab === 'menu'" class="p-6 md:p-8 space-y-8" x-transition.opacity>
    <div class="flex justify-between items-center border-b border-gray-100 pb-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Menu Best Seller</h2>
            <p class="text-xs text-gray-400">Pilih 3 menu dari database untuk ditampilkan di halaman depan.</p>
        </div>
        <button @click="saveBestSellers()" :disabled="loading"
            class="px-4 py-2 bg-heritage-red text-white rounded-lg hover:bg-red-800 text-sm font-bold shadow transition disabled:opacity-50">
            <span x-show="!loading">💾 Simpan</span>
            <span x-show="loading">Menyimpan...</span>
        </button>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Slot 1 -->
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold text-heritage-red uppercase mb-2">Slot 1 (Highlight
                        Utama)</label>
                    <select x-model="slot1" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                        <option value="">-- Pilih Menu --</option>
                        <template x-for="menu in menus" :key="menu.id">
                            <option :value="menu.id" x-text="menu.name"></option>
                        </template>
                    </select>
                </div>
                <div
                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                    <img :src="getMenu(slot1).image_url || 'https://via.placeholder.com/100'"
                        class="w-16 h-16 rounded-md object-cover bg-gray-200">
                    <div>
                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot1).name || 'Pilih Menu'"></p>
                        <p class="text-xs text-heritage-red font-bold"
                            x-text="getMenu(slot1).price ? 'Rp ' + Number(getMenu(slot1).price).toLocaleString('id-ID') : '-'">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slot 2 -->
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Slot 2</label>
                    <select x-model="slot2" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                        <option value="">-- Pilih Menu --</option>
                        <template x-for="menu in menus" :key="menu.id">
                            <option :value="menu.id" x-text="menu.name"></option>
                        </template>
                    </select>
                </div>
                <div
                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                    <img :src="getMenu(slot2).image_url || 'https://via.placeholder.com/100'"
                        class="w-16 h-16 rounded-md object-cover bg-gray-200">
                    <div>
                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot2).name || 'Pilih Menu'"></p>
                        <p class="text-xs text-heritage-red font-bold"
                            x-text="getMenu(slot2).price ? 'Rp ' + Number(getMenu(slot2).price).toLocaleString('id-ID') : '-'">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slot 3 -->
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Slot 3</label>
                    <select x-model="slot3" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3">
                        <option value="">-- Pilih Menu --</option>
                        <template x-for="menu in menus" :key="menu.id">
                            <option :value="menu.id" x-text="menu.name"></option>
                        </template>
                    </select>
                </div>
                <div
                    class="w-full md:w-1/2 flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                    <img :src="getMenu(slot3).image_url || 'https://via.placeholder.com/100'"
                        class="w-16 h-16 rounded-md object-cover bg-gray-200">
                    <div>
                        <p class="text-sm font-bold text-gray-800" x-text="getMenu(slot3).name || 'Pilih Menu'"></p>
                        <p class="text-xs text-heritage-red font-bold"
                            x-text="getMenu(slot3).price ? 'Rp ' + Number(getMenu(slot3).price).toLocaleString('id-ID') : '-'">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($menuItems->isEmpty())
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
            <p class="text-yellow-700 text-sm">
                <strong>Belum ada menu!</strong> Silakan tambahkan menu terlebih dahulu di
                <a href="{{ route('admin.menu.index') }}" class="underline text-heritage-red">Menu Management</a>.
            </p>
        </div>
    @endif
</div>
