<div x-show="activeTab === 'about'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Edit Tentang Kami</h2>
    </div>

    <form action="{{ route('admin.landing-page.about.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Section</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm p-3"
                        value="{{ $aboutSection->title ?? 'Mewujudkan \"Dreamland\" di Tanah Ponorogo' }}"
                        placeholder="Mewujudkan Mimpi di Tanah Ponorogo">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Utama</label>
                    <textarea rows="4" name="description" class="w-full border-gray-300 rounded-lg shadow-sm p-3"
                        placeholder="Deskripsi tentang Ponorogo Dreamland...">{{ $aboutSection->description ?? 'Ponorogo Dreamland lahir dari sebuah mimpi sederhana: menyediakan satu tempat di mana tradisi lokal dapat berpadu harmonis dengan kenyamanan modern.' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Tambahan</label>
                    <textarea rows="4" name="extra_description" class="w-full border-gray-300 rounded-lg shadow-sm p-3"
                        placeholder="Deskripsi tambahan...">{{ $aboutSection->extra_data['extra_description'] ?? 'Kami percaya bahwa momen terbaik diciptakan melalui makanan yang lezat, suasana yang hangat, dan tempat yang nyaman.' }}</textarea>
                </div>

                <button type="submit"
                    class="px-6 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 text-sm font-medium shadow-lg transition">
                    Simpan Tentang Kami
                </button>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700">Foto Ilustrasi (Max 2)</label>

                @php
                    $leftImage = $aboutSection?->images->where('image_type', 'left')->first();
                    $rightImage = $aboutSection?->images->where('image_type', 'right')->first();
                @endphp

                <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                    @if ($leftImage)
                        <div class="relative">
                            <img src="{{ $leftImage->image_url }}"
                                class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md bg-gray-200">
                            <button type="button" @click="deleteImage('{{ $leftImage->id }}')"
                                class="absolute -top-2 -right-2 bg-red-500 text-white p-1 rounded-full shadow-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @else
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gray-200 rounded-md flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 overflow-hidden">
                        <p class="text-xs md:text-sm font-bold text-gray-700 mb-1">Foto Kiri</p>
                        <input type="file" class="text-xs w-full text-gray-500" accept="image/*"
                            @change="handleFileSelect($event, 'about', 'left')">
                    </div>
                </div>

                <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">
                    @if ($rightImage)
                        <div class="relative">
                            <img src="{{ $rightImage->image_url }}"
                                class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md bg-gray-200">
                            <button type="button" @click="deleteImage('{{ $rightImage->id }}')"
                                class="absolute -top-2 -right-2 bg-red-500 text-white p-1 rounded-full shadow-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @else
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gray-200 rounded-md flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 overflow-hidden">
                        <p class="text-xs md:text-sm font-bold text-gray-700 mb-1">Foto Kanan</p>
                        <input type="file" class="text-xs w-full text-gray-500" accept="image/*"
                            @change="handleFileSelect($event, 'about', 'right')">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
