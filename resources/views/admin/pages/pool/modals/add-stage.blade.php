<div x-data="{ open: false }" x-on:open-modal.window="if ($event.detail === 'add-stage-modal') open = true">
    <div x-show="open" class="fixed inset-0 z-80 flex items-center justify-center bg-black/50" x-transition.opacity
        style="display: none;">
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-lg relative" @click.away="open = false">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Tambah Tahap Baru</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.pool.timeline.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Judul Tahap</label>
                        <input type="text" name="title" class="input-pool w-full border-gray-300 rounded-lg p-2.5"
                            required placeholder="Contoh: Perencanaan">
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Periode</label>
                            <input type="text" name="period"
                                class="input-pool w-full border-gray-300 rounded-lg p-2.5" placeholder="Jan - Feb 2026">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                            <select name="status" class="input-pool w-full border-gray-300 rounded-lg p-2.5">
                                <option value="planned">📅 Planned</option>
                                <option value="on_progress">🚧 On Progress</option>
                                <option value="done">✅ Done</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Persentase Awal</label>
                        <input type="number" name="progress_percentage" min="0" max="100" value="0"
                            class="input-pool w-full border-gray-300 rounded-lg p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="3" class="input-pool w-full border-gray-300 rounded-lg p-2.5"
                            placeholder="Detail kegiatan..."></textarea>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
