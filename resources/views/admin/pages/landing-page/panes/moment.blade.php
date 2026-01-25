<div x-show="activeTab === 'moment'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
        <div>
            <h2 class="text-lg md:text-xl font-bold text-gray-800">Momen Spesial</h2>
            <p class="text-gray-500 text-xs md:text-sm">Galeri foto pengunjung.</p>
        </div>
        @php
            $imageCount = $momentSection?->images->count() ?? 0;
        @endphp
        <span class="text-xs md:text-sm font-medium {{ $imageCount >= 4 ? 'text-orange-500' : 'text-green-600' }}">
            {{ $imageCount }} / 4 Slot
        </span>
    </div>

    <form action="{{ route('admin.landing-page.moment.update') }}" method="POST" class="mb-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Section</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm p-3"
                    value="{{ $momentSection->title ?? 'Momen di Dreamland' }}" placeholder="Momen di Dreamland">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" class="w-full border-gray-300 rounded-lg shadow-sm p-3"
                    value="{{ $momentSection->subtitle ?? 'Lihat bagaimana pengunjung kami menikmati waktunya.' }}"
                    placeholder="Lihat bagaimana pengunjung...">
            </div>
        </div>

        <button type="submit"
            class="px-6 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 text-sm font-medium shadow-lg transition">
            Simpan Momen
        </button>
    </form>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
        @if ($momentSection && $momentSection->images->count() > 0)
            @foreach ($momentSection->images as $image)
                <div class="group relative aspect-square rounded-xl overflow-hidden shadow-sm">
                    <img src="{{ $image->image_url }}" alt="{{ $image->alt_text ?? 'Moment Image' }}"
                        class="w-full h-full object-cover">
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">
                        <span class="text-white text-xs font-bold">{{ $image->alt_text ?? 'Gambar Momen' }}</span>
                    </div>
                    <button type="button" @click="deleteImage('{{ $image->id }}')"
                        class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full shadow-md">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            @endforeach
        @endif

        @if (!$momentSection || $momentSection->images->count() < 4)
            <label
                class="cursor-pointer file-zone rounded-xl flex flex-col items-center justify-center aspect-square bg-gray-50 text-gray-400 hover:text-green-600">
                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-xs font-bold">Upload</span>
                <input type="file" class="hidden" accept="image/*"
                    @change="handleFileSelect($event, 'moment', 'gallery')">
            </label>
        @endif
    </div>
</div>
