<div x-show="modalOpen" class="fixed inset-0 z-80 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    x-transition.opacity>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md m-4 overflow-hidden" @click.away="modalOpen = false">
        <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-800">Detail Reservasi</h3>
            <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="p-6 space-y-4" x-data="{ detail: selectedItem }">

            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500 uppercase">Pemesan</p>
                    <h4 class="font-bold text-lg text-gray-800" x-text="detail.name"></h4>
                    <p class="text-sm text-indigo-600 font-mono" x-text="detail.wa"></p>
                </div>
                <div class="text-right">
                    <span :class="getStatusClass(detail.status)"
                        class="px-2 py-1 rounded border text-xs font-bold uppercase" x-text="detail.status"></span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                <div>
                    <p class="text-xs text-gray-500 uppercase">Venue</p>
                    <p class="font-bold text-gray-800" x-text="detail.venue"></p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase">Pax</p>
                    <p class="font-bold text-gray-800"><span x-text="detail.pax"></span> Orang</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                    <p class="font-bold text-gray-800" x-text="detail.date"></p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase">Jam</p>
                    <p class="font-bold text-gray-800" x-text="detail.time"></p>
                </div>
            </div>

            <div>
                <p class="text-xs text-gray-500 uppercase mb-1">Catatan Khusus</p>
                <div class="p-3 bg-yellow-50 border border-yellow-100 rounded-lg text-sm text-gray-700 italic">
                    "<span x-text="detail.notes || 'Tidak ada catatan'"></span>"
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-500">Status Pesan WA:</span>
                <span :class="detail.wa_status === 'sent' ? 'text-green-600' : 'text-red-600'"
                    class="font-bold text-sm flex items-center gap-1">
                    <span x-text="detail.wa_status === 'sent' ? '✓ Terkirim Otomatis' : '⚠ Gagal Terkirim'"></span>
                    <button x-show="detail.wa_status === 'failed'" class="text-xs underline ml-2 text-indigo-600">Coba
                        Lagi</button>
                </span>
            </div>

        </div>
        <div class="p-4 bg-gray-50 flex gap-2">
            <button
                class="flex-1 py-2 border border-gray-300 rounded-lg text-gray-600 font-bold hover:bg-white transition">Tolak</button>
            <button
                class="flex-1 py-2 bg-indigo-600 rounded-lg text-white font-bold hover:bg-indigo-700 transition">Konfirmasi</button>
        </div>
    </div>
</div>
