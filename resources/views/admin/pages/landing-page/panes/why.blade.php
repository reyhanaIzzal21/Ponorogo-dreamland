<div x-show="activeTab === 'why'" class="space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Edit Why Choose Us</h2>
            <p class="text-gray-500 text-sm">Poin keunggulan (Maksimal 4 Poin).</p>
        </div>
        <button class="text-xs bg-gray-200 text-gray-400 font-bold px-3 py-1 rounded cursor-not-allowed" disabled>
            Maksimal Tercapai (4/4)
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="border border-gray-200 p-4 rounded-xl hover:shadow-md transition bg-white relative group">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-xl">📍
                </div>
                <div class="flex-1 space-y-2">
                    <input type="text"
                        class="w-full text-sm font-bold border-0 border-b border-gray-200 focus:ring-0 px-0 py-1"
                        value="Lokasi Strategis">
                    <textarea rows="2" class="w-full text-xs text-gray-600 border-0 bg-gray-50 rounded p-2 focus:ring-0">Mudah dijangkau, tepat di jantung aktivitas dan kenyamanan.</textarea>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 p-4 rounded-xl hover:shadow-md transition bg-white relative group">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-xl">✨
                </div>
                <div class="flex-1 space-y-2">
                    <input type="text"
                        class="w-full text-sm font-bold border-0 border-b border-gray-200 focus:ring-0 px-0 py-1"
                        value="Fasilitas Lengkap">
                    <textarea rows="2" class="w-full text-xs text-gray-600 border-0 bg-gray-50 rounded p-2 focus:ring-0">One-stop destination: Makan, Acara, dan Hiburan keluarga.</textarea>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 p-4 rounded-xl hover:shadow-md transition bg-white relative group">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-xl">🤝
                </div>
                <div class="flex-1 space-y-2">
                    <input type="text"
                        class="w-full text-sm font-bold border-0 border-b border-gray-200 focus:ring-0 px-0 py-1"
                        value="Pelayanan Ramah">
                    <textarea rows="2" class="w-full text-xs text-gray-600 border-0 bg-gray-50 rounded p-2 focus:ring-0">Keramahan khas Ponorogo dengan standar layanan profesional.</textarea>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 p-4 rounded-xl hover:shadow-md transition bg-white relative group">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-xl">🏛️
                </div>
                <div class="flex-1 space-y-2">
                    <input type="text"
                        class="w-full text-sm font-bold border-0 border-b border-gray-200 focus:ring-0 px-0 py-1"
                        value="Suasana Otentik">
                    <textarea rows="2" class="w-full text-xs text-gray-600 border-0 bg-gray-50 rounded p-2 focus:ring-0">Perpaduan desain modern dan sentuhan tradisional Jawa.</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
