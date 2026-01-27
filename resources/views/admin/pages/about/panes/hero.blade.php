<div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Hero Narrative</h2>
        <p class="text-gray-500 text-xs md:text-sm">Bagian pembuka dengan gaya editorial.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Headline Besar</label>
                <input type="text" name="hero_title"
                    class="input-about w-full border-gray-300 rounded-lg shadow-sm p-3 font-serif text-lg"
                    value="{{ old('hero_title', $about->hero_title) }}">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Sub-Headline</label>
                <textarea rows="4" name="hero_subtitle"
                    class="input-about w-full border-gray-300 rounded-lg shadow-sm p-3 leading-relaxed">{{ old('hero_subtitle', $about->hero_subtitle) }}</textarea>
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Hero Photo (Blob Shape)</label>
            <div
                class="bg-gray-50 p-6 rounded-xl border border-dashed border-gray-300 flex flex-col items-center justify-center">
                <div
                    class="preview-blob w-48 h-48 md:w-64 md:h-64 shadow-xl relative group cursor-pointer bg-slate-200">
                    <img src="{{ $about->hero_blob_image ? Storage::url($about->hero_blob_image) : 'https://images.unsplash.com/photo-1561582806-398d287178d6?q=80&w=600' }}"
                        class="w-full h-full object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-xs font-bold border border-white px-2 py-1 rounded">Ubah
                            Foto</span>
                    </div>
                    <input type="file" name="hero_blob_image" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                <p class="text-xs text-orange-500 mt-4 font-bold">⚠️ Penting: Gunakan foto rasio 1:1
                    (Square) agar bentuk blob sempurna.</p>
            </div>
        </div>
    </div>
</div>
