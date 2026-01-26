<div x-show="activeTab === 'hero'" class="p-6 md:p-8 space-y-8" x-transition.opacity>
    <div class="flex justify-between items-center border-b border-gray-100 pb-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Hero Section</h2>
            <p class="text-xs text-gray-400">Tampilan utama saat user masuk halaman resto.</p>
        </div>
        <button @click="submitForm('heroForm', '{{ route('admin.restaurant.hero.update') }}')" :disabled="loading"
            class="px-4 py-2 bg-heritage-red text-white rounded-lg hover:bg-red-800 text-sm font-bold shadow transition disabled:opacity-50">
            <span x-show="!loading">💾 Simpan</span>
            <span x-show="loading">Menyimpan...</span>
        </button>
    </div>

    <form id="heroForm" class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Main Title</label>
                <input type="text" name="title"
                    class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3 font-serif text-xl"
                    value="{{ $heroSection->title ?? 'Cita Rasa Tradisional' }}">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Main Title <span
                        class="text-yellow-500">(Akan tampil berwarna kuning)</span></label>
                <input type="text" name="subtitle"
                    class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3 font-serif text-xl"
                    value="{{ $heroSection->subtitle ?? 'di Jantung Ponorogo' }}">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Sub Title</label>
                <textarea name="description" class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3 h-32">{{ $heroSection->description ?? 'Nikmati hidangan warisan leluhur dengan sentuhan modern, disajikan dalam kehangatan suasana kekeluargaan.' }}</textarea>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Background Image</label>
            <div
                class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-heritage-red transition cursor-pointer">
                @php
                    $bgImage =
                        $heroSection?->getExtraValue('background_image') ??
                        'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=800';
                    if ($bgImage && !str_starts_with($bgImage, 'http')) {
                        $bgImage = asset('storage/' . $bgImage);
                    }
                @endphp
                <img src="{{ $bgImage }}"
                    class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-500"
                    id="heroPreview">
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="text-white text-xs font-bold">Ganti Background</span>
                </div>
                <input type="file" name="background_image" accept="image/*"
                    class="absolute inset-0 opacity-0 cursor-pointer"
                    onchange="document.getElementById('heroPreview').src = URL.createObjectURL(this.files[0])">
            </div>
            <p class="text-xs text-gray-400 mt-2 text-center">Disarankan ukuran 1920x1080px (Landscape)</p>
        </div>
    </form>
</div>
