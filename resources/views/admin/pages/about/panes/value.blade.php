<div x-show="activeTab === 'values'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Nilai Inti (Bento Grid)</h2>
        <p class="text-gray-500 text-xs md:text-sm">Kelola 3 kartu utama. Kartu ke-3 membutuhkan foto
            background.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-6">
            <div class="border-l-4 border-green-600 bg-white p-4 shadow-sm rounded-r-xl border border-gray-100">
                <h3 class="text-xs font-bold text-green-800 uppercase mb-3">Card 1: Otentik</h3>
                <div class="flex gap-2 mb-2">
                    <input type="text" class="input-about w-16 border-gray-300 rounded text-center" value="🏛️">
                    <input type="text" class="input-about w-full border-gray-300 rounded font-bold" value="Otentik">
                </div>
                <textarea rows="2" class="input-about w-full border-gray-300 rounded text-sm">Menjaga resep warisan leluhur dan arsitektur asli.</textarea>
            </div>

            <div class="border-l-4 border-blue-500 bg-white p-4 shadow-sm rounded-r-xl border border-gray-100">
                <h3 class="text-xs font-bold text-blue-800 uppercase mb-3">Card 2: Inovatif</h3>
                <div class="flex gap-2 mb-2">
                    <input type="text" class="input-about w-16 border-gray-300 rounded text-center" value="🚀">
                    <input type="text" class="input-about w-full border-gray-300 rounded font-bold" value="Inovatif">
                </div>
                <textarea rows="2" class="input-about w-full border-gray-300 rounded text-sm">Terus berkembang dengan fasilitas modern.</textarea>
            </div>
        </div>

        <div class="border border-gray-200 rounded-xl overflow-hidden relative group h-full min-h-[250px] bg-slate-900">
            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=400"
                class="w-full h-full object-cover opacity-30">

            <div class="absolute inset-0 p-6 flex flex-col justify-center">
                <span class="text-xs font-bold text-yellow-400 uppercase mb-2">Card 3: Kehangatan</span>
                <div class="flex gap-2 mb-2">
                    <input type="text"
                        class="bg-black/30 border-white/30 text-white w-12 rounded text-center focus:ring-0"
                        value="🤝">
                    <input type="text"
                        class="bg-black/30 border-white/30 text-white w-full rounded font-bold focus:ring-0"
                        value="Kehangatan">
                </div>
                <textarea rows="3" class="bg-black/30 border-white/30 text-white w-full rounded text-sm focus:ring-0">Pelayanan yang membuat Anda merasa seperti pulang.</textarea>
            </div>

            <div class="absolute bottom-4 right-4">
                <label class="bg-white text-xs font-bold px-3 py-1 rounded cursor-pointer hover:bg-gray-200">
                    Ganti Background
                    <input type="file" class="hidden">
                </label>
            </div>
        </div>
    </div>
</div>
