<div x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    x-transition.opacity>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden m-4" @click.away="closeModal()">

        <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-gray-800 font-bold text-lg"
                x-text="modalMode === 'add' ? 'Tambah Destinasi Baru' : 'Edit Destinasi'"></h3>
            <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>

        <div class="p-6 space-y-4">

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Destinasi</label>
                <input type="text" x-model="form.name"
                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2.5">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipe Bisnis</label>
                    <select x-model="form.type"
                        class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2.5">
                        <option value="Resto">F&B (Resto)</option>
                        <option value="Venue">Venue (Gedung)</option>
                        <option value="Recreation">Recreation (Wisata)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Status Operasional</label>
                    <select x-model="form.status"
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
                <textarea x-model="form.desc" rows="3"
                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2.5"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Cover Image</label>
                <input type="file"
                    class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>

        </div>

        <div class="bg-gray-50 p-4 flex justify-end gap-2">
            <button @click="closeModal()"
                class="px-4 py-2 text-gray-600 text-sm font-bold hover:bg-gray-200 rounded-lg transition">Batal</button>
            <button
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-700 shadow-md transition">Simpan
                Perubahan</button>
        </div>
    </div>
</div>
