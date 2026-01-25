<div x-show="activeTab === 'extra'" class="p-4 md:p-8 space-y-8" x-transition.opacity>

    <div>
        <h2 class="text-lg font-bold text-gray-800 mb-4">Statistik (Counter)</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-green-50 p-4 rounded-lg border border-green-100 text-center">
                <label class="block text-xs font-bold text-green-800 mb-1">Label 1</label>
                <input type="text" class="input-about w-full text-center text-sm mb-2" value="Unit Bisnis">
                <label class="block text-xs font-bold text-green-800 mb-1">Angka</label>
                <input type="number" class="input-about w-full text-center font-bold text-xl" value="3">
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-100 text-center">
                <label class="block text-xs font-bold text-green-800 mb-1">Label 2</label>
                <input type="text" class="input-about w-full text-center text-sm mb-2" value="Pengunjung">
                <label class="block text-xs font-bold text-green-800 mb-1">Angka (+)</label>
                <input type="number" class="input-about w-full text-center font-bold text-xl" value="1000">
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-100 text-center">
                <label class="block text-xs font-bold text-green-800 mb-1">Label 3</label>
                <input type="text" class="input-about w-full text-center text-sm mb-2" value="Lokal Ponorogo">
                <label class="block text-xs font-bold text-green-800 mb-1">Persentase (%)</label>
                <input type="number" class="input-about w-full text-center font-bold text-xl" value="100">
            </div>
        </div>
    </div>

    <div class="border-t border-gray-100 pt-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Founder Quote</h2>
        <div class="bg-slate-800 p-6 rounded-xl text-white">
            <div class="text-4xl text-yellow-500 font-serif mb-2">“</div>
            <textarea rows="3"
                class="w-full bg-slate-700 border-slate-600 rounded-lg text-lg font-serif mb-4 focus:ring-yellow-500 focus:border-yellow-500">Kami ingin menciptakan tempat di mana teknologi dan tradisi tidak saling bertentangan.</textarea>

            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-xs text-slate-400 mb-1">Nama / Jabatan</label>
                    <input type="text" class="w-full bg-slate-700 border-slate-600 rounded text-sm" value="Founder">
                </div>
                <div class="w-1/2">
                    <label class="block text-xs text-slate-400 mb-1">Sub Jabatan</label>
                    <input type="text" class="w-full bg-slate-700 border-slate-600 rounded text-sm"
                        value="Ponorogo Dreamland">
                </div>
            </div>
        </div>
    </div>

</div>
