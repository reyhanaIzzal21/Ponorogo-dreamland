<div x-show="activeTab === 'gallery'" class="p-6 md:p-8 space-y-8" x-transition.opacity>

    <div>
        <div class="flex justify-between items-center mb-4">
            <label class="block text-sm font-bold text-gray-700">Sudut Estetik (Maksimal 4 Foto)</label>
            <span class="text-xs font-medium bg-gray-100 px-2 py-1 rounded">{{ $galleryCount }}/4 Terisi</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($galleryImages as $image)
                <div class="relative group aspect-square rounded-xl overflow-hidden shadow-sm bg-gray-100">
                    @php
                        $imageUrl = $image->image_path;
                        if ($imageUrl && !str_starts_with($imageUrl, 'http')) {
                            $imageUrl = asset('storage/' . $imageUrl);
                        }
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $image->alt_text ?? 'Gallery image' }}"
                        class="w-full h-full object-cover">
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                        <button @click="deleteGalleryImage('{{ $image->id }}')"
                            class="p-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <!-- Empty slots -->
            @endforelse

            @if ($galleryCount < 4)
                <div
                    class="relative group aspect-square rounded-xl overflow-hidden shadow-sm bg-gray-100 border-2 border-dashed border-gray-300 hover:border-primary transition cursor-pointer flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span class="text-xs text-gray-400">Tambah Foto</span>
                    </div>
                    <input type="file" accept="image/*" @change="uploadGalleryImage($event)"
                        class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            @endif
        </div>
    </div>

    <hr class="border-gray-100">

    <div>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-sm font-bold text-gray-700">Integrasi Sosial Media</h3>
            <button @click="submitForm('socialMediaForm', '{{ route('admin.restaurant.social-media.update') }}')"
                :disabled="loading"
                class="px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-green-800 text-xs font-bold shadow transition disabled:opacity-50">
                <span x-show="!loading">💾 Simpan</span>
                <span x-show="loading">...</span>
            </button>
        </div>
        <form id="socialMediaForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="relative">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Instagram Username</label>
                <div class="flex items-center">
                    <span
                        class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg px-3 py-3 text-gray-500">@</span>
                    <input type="text" name="instagram_username"
                        class="input-resto w-full rounded-r-lg border-gray-300 shadow-sm p-3"
                        value="{{ $heroSection?->getExtraValue('instagram_username') ?? 'ponorogo.dreamland' }}">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Direct Link (URL)</label>
                <input type="url" name="instagram_url"
                    class="input-resto w-full rounded-lg border-gray-300 shadow-sm p-3"
                    value="{{ $heroSection?->getExtraValue('instagram_url') ?? 'https://instagram.com/ponorogo.dreamland' }}">
            </div>
        </form>
    </div>
</div>
