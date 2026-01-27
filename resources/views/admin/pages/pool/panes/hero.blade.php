<div x-show="activeTab === 'hero'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Hero Teaser</h2>
        <p class="text-gray-500 text-xs md:text-sm">Atur pesan pembuka dan target waktu peluncuran.</p>
    </div>

    <form action="{{ route('admin.pool.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Badge Text</label>
                    <input type="text" name="badge_text"
                        class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3 font-mono text-sm"
                        value="{{ old('badge_text', $content->badge_text ?? 'COMING SOON 2026') }}">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Main Headline</label>
                    <input type="text" name="main_headline"
                        class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3 font-bold"
                        value="{{ old('main_headline', $content->main_headline ?? 'The New ') }}">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Main Headline <span
                            class="text-blue-500">(Akan tampil berwarna biru)</span></label>
                    <input type="text" name="blue_headline"
                        class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3 font-bold"
                        value="{{ old('blue_headline', $content->blue_headline ?? 'Oasis in Town') }}">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sub Headline</label>
                    <textarea name="sub_headline" rows="3" class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3">{{ old('sub_headline', $content->sub_headline ?? 'Segarkan hari Anda di destinasi terbaru Ponorogo. Perpaduan kesejukan air dan estetika modern.') }}</textarea>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl">
                    <label class="block text-sm font-bold text-blue-800 mb-2">📅 Target Launching Date</label>
                    <p class="text-xs text-blue-600 mb-3">Sistem akan otomatis menghitung mundur (Countdown)
                        berdasarkan tanggal ini.</p>
                    <input type="date" name="launch_date"
                        class="input-pool w-full border-gray-300 rounded-lg shadow-sm p-3"
                        value="{{ old('launch_date', isset($content->launch_date) ? $content->launch_date->format('Y-m-d') : '') }}">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Teaser Background (3D
                        Render)</label>
                    <div
                        class="relative group rounded-xl overflow-hidden aspect-video bg-gray-100 border-2 border-dashed border-gray-300 hover:border-accent transition cursor-pointer">
                        <img src="{{ isset($content->teaser_background) ? asset('storage/' . $content->teaser_background) : 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=600' }}"
                            class="w-full h-full object-cover opacity-80 mix-blend-multiply">
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center bg-blue-900/40 opacity-0 group-hover:opacity-100 transition">
                            <span class="text-white text-xs font-bold border border-white px-3 py-1 rounded-full">Ganti
                                Render</span>
                        </div>
                        <input type="file" name="teaser_background"
                            class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Simpan
                Perubahan</button>
        </div>
    </form>
</div>
