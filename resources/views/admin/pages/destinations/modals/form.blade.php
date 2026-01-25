<div x-show="isModalOpen" class="fixed inset-0 z-80 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    x-transition.opacity @click.self="closeModal()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden m-4" @click.stop>

        <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-gray-800 font-bold text-lg"
                x-text="modalMode === 'add' ? 'Tambah Destinasi Baru' : 'Edit Destinasi'"></h3>
            <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>

        <form @submit.prevent="saveDestination()" enctype="multipart/form-data">
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Destinasi <span
                            class="text-red-500">*</span></label>
                    <input type="text" x-model="form.name" required
                        class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2.5"
                        placeholder="Contoh: Dam Cokro Resto">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipe Bisnis <span
                                class="text-red-500">*</span></label>
                        <select x-model="form.type" required
                            class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2.5">
                            <option value="restaurant">F&B (Resto)</option>
                            <option value="venue">Venue (Gedung)</option>
                            <option value="recreation">Recreation (Wisata)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Status Operasional <span
                                class="text-red-500">*</span></label>
                        <select x-model="form.status" required
                            class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2.5">
                            <option value="open">🟢 Open</option>
                            <option value="closed">🔴 Closed</option>
                            <option value="soon">🚧 Coming Soon</option>
                            <option value="maintenance">🔧 Maintenance</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Deskripsi Singkat</label>
                    <textarea x-model="form.description" rows="3"
                        class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2.5"
                        placeholder="Deskripsi singkat tentang destinasi ini..."></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Cover Image</label>
                    <input type="file" @change="handleImageChange($event)" accept="image/*"
                        class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, atau WebP. Maks: 2MB</p>
                </div>

            </div>

            <div class="bg-gray-50 p-4 flex justify-end gap-2">
                <button type="button" @click="closeModal()"
                    class="px-4 py-2 text-gray-600 text-sm font-bold hover:bg-gray-200 rounded-lg transition">Batal</button>
                <button type="submit" :disabled="isSaving"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-700 shadow-md transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                    <svg x-show="isSaving" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span x-text="isSaving ? 'Menyimpan...' : 'Simpan'"></span>
                </button>
            </div>
        </form>
    </div>
</div>
