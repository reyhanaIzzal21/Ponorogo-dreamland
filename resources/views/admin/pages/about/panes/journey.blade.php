<div x-show="activeTab === 'journey'" class="p-4 md:p-8 space-y-8" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Cerita & Filosofi (Zig-Zag)</h2>
        <p class="text-gray-500 text-xs md:text-sm">3 slot konten tetap yang akan tampil bergantian arah
            (Kiri-Kanan-Kiri).</p>
    </div>

    <div class="border border-gray-200 rounded-xl p-4 bg-white relative">
        <div
            class="absolute -left-3 -top-3 w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
            01</div>
        <div class="flex flex-col md:flex-row gap-4 mt-2">
            <div class="md:w-1/3">
                <label class="block text-xs font-bold text-gray-500 mb-1">Foto (Kiri)</label>
                <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden relative group cursor-pointer">
                    <img src="{{ $about->story_1_image ? Storage::url($about->story_1_image) : 'https://images.unsplash.com/photo-1528696892704-5f65b8252455?q=80&w=300' }}"
                        class="w-full h-full object-cover">
                    <input type="file" name="story_1_image" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>
            <div class="md:w-2/3 space-y-3">
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">Judul Cerita</label>
                    <input type="text" name="story_1_title"
                        class="input-about w-full border-gray-300 rounded text-sm font-bold"
                        value="{{ old('story_1_title', $about->story_1_title) }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">Narasi</label>
                    <textarea rows="3" name="story_1_description"
                        class="input-about w-full border-gray-300 rounded text-sm text-gray-600">{{ old('story_1_description', $about->story_1_description) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="border border-gray-200 rounded-xl p-4 bg-slate-50 relative">
        <div
            class="absolute -left-3 -top-3 w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
            02</div>
        <div class="text-right mb-2 text-xs text-orange-500 font-bold italic">⚡ Tampilan di website akan
            terbalik (Foto di Kanan)</div>

        <div class="flex flex-col md:flex-row-reverse gap-4">
            <div class="md:w-1/3">
                <label class="block text-xs font-bold text-gray-500 mb-1 text-right">Foto (Kanan)</label>
                <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden relative group cursor-pointer">
                    <img src="{{ $about->story_2_image ? Storage::url($about->story_2_image) : 'https://images.unsplash.com/photo-1464695110811-dcf3903dc2f4?q=80&w=300' }}"
                        class="w-full h-full object-cover">
                    <input type="file" name="story_2_image" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>
            <div class="md:w-2/3 space-y-3">
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">Judul Cerita</label>
                    <input type="text" name="story_2_title"
                        class="input-about w-full border-gray-300 rounded text-sm font-bold"
                        value="{{ old('story_2_title', $about->story_2_title) }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">Narasi</label>
                    <textarea rows="3" name="story_2_description"
                        class="input-about w-full border-gray-300 rounded text-sm text-gray-600">{{ old('story_2_description', $about->story_2_description) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="border border-gray-200 rounded-xl p-4 bg-white relative">
        <div
            class="absolute -left-3 -top-3 w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
            03</div>
        <div class="flex flex-col md:flex-row gap-4 mt-2">
            <div class="md:w-1/3">
                <label class="block text-xs font-bold text-gray-500 mb-1">Foto (Kiri)</label>
                <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden relative group cursor-pointer">
                    <img src="{{ $about->story_3_image ? Storage::url($about->story_3_image) : 'https://images.unsplash.com/photo-1581578731117-104f2a8d46a8?q=80&w=300' }}"
                        class="w-full h-full object-cover grayscale">
                    <input type="file" name="story_3_image" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>
            <div class="md:w-2/3 space-y-3">
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">Judul Cerita</label>
                    <input type="text" name="story_3_title"
                        class="input-about w-full border-gray-300 rounded text-sm font-bold"
                        value="{{ old('story_3_title', $about->story_3_title) }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">Narasi</label>
                    <textarea rows="3" name="story_3_description"
                        class="input-about w-full border-gray-300 rounded text-sm text-gray-600">{{ old('story_3_description', $about->story_3_description) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
