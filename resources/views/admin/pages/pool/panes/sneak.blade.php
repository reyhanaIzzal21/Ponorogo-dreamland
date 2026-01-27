<div x-show="activeTab === 'sneak'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Sneak Peek Experience</h2>
        <p class="text-gray-500 text-xs md:text-sm">Kelola 4 slot konten bento grid.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- SLOT 1 --}}
        @php $slot1 = $sneakPeeks->where('slot_number', 1)->first(); @endphp
        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group">
            <span
                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                1 (Utama/Besar)</span>
            <form action="{{ route('admin.pool.sneak-peek.update', 1) }}" method="POST" enctype="multipart/form-data"
                class="mt-6 space-y-3">
                @csrf
                @method('PUT')
                <input type="text" name="title" class="input-pool w-full border-gray-300 rounded text-sm font-bold"
                    value="{{ old('title', $slot1->title ?? 'Family & Kids Friendly') }}" placeholder="Judul">
                <textarea name="description" rows="2" class="input-pool w-full border-gray-300 rounded text-xs text-gray-600"
                    placeholder="Deskripsi">{{ old('description', $slot1->description ?? 'Wahana air aman untuk keluarga.') }}</textarea>
                <div class="flex items-center gap-3">
                    <img src="{{ isset($slot1->image_path) ? asset('storage/' . $slot1->image_path) : 'https://images.unsplash.com/photo-1572331165267-854da2b00dc1?q=80&w=100' }}"
                        class="w-12 h-12 rounded object-cover bg-gray-100">
                    <div class="flex-1">
                        <input type="file" name="image" class="text-xs text-gray-500 w-full">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>

        {{-- SLOT 2 --}}
        @php $slot2 = $sneakPeeks->where('slot_number', 2)->first(); @endphp
        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group">
            <span
                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                2 (Iconic)</span>
            <form action="{{ route('admin.pool.sneak-peek.update', 2) }}" method="POST" enctype="multipart/form-data"
                class="mt-6 space-y-3">
                @csrf
                @method('PUT')
                <div class="flex gap-2">
                    <input type="text" name="title"
                        class="input-pool w-full border-gray-300 rounded text-sm font-bold"
                        value="{{ old('title', $slot2->title ?? 'Aesthetic Poolside') }}" placeholder="Judul">
                </div>
                <input type="text" name="description"
                    class="input-pool w-full border-gray-300 rounded text-xs text-gray-600"
                    value="{{ old('description', $slot2->description ?? 'Spot foto Instagramable') }}"
                    placeholder="Deskripsi Singkat">
                <div class="flex items-center gap-3 mt-2">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>

        {{-- SLOT 3 --}}
        @php $slot3 = $sneakPeeks->where('slot_number', 3)->first(); @endphp
        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group">
            <span
                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                3 (Spotlight)</span>
            <form action="{{ route('admin.pool.sneak-peek.update', 3) }}" method="POST" enctype="multipart/form-data"
                class="mt-6 space-y-3">
                @csrf
                @method('PUT')
                <div class="flex items-center gap-3">
                    <img src="{{ isset($slot3->image_path) ? asset('storage/' . $slot3->image_path) : 'https://images.unsplash.com/photo-1596120800912-74737dd3c880?q=80&w=100' }}"
                        class="w-12 h-12 rounded object-cover bg-gray-100">
                    <div class="flex-1">
                        <input type="text" name="title"
                            class="input-pool w-full border-gray-300 rounded text-sm font-bold mb-1"
                            value="{{ old('title', $slot3->title ?? 'Mini Cafe') }}" placeholder="Judul">
                        <input type="file" name="image" class="text-xs text-gray-500 w-full mb-1">
                        <button type="submit"
                            class="bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700 w-full">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- SLOT 4 --}}
        @php $slot4 = $sneakPeeks->where('slot_number', 4)->first(); @endphp
        <div class="border border-gray-200 rounded-xl p-4 bg-white relative group md:col-span-2">
            <span
                class="absolute top-0 left-0 bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-lg">SLOT
                4 (Detail/Fasilitas)</span>
            <form action="{{ route('admin.pool.sneak-peek.update', 4) }}" method="POST" enctype="multipart/form-data"
                class="mt-6 flex flex-col md:flex-row gap-4">
                @csrf
                @method('PUT')
                <div class="md:w-1/3">
                    <img src="{{ isset($slot4->image_path) ? asset('storage/' . $slot4->image_path) : 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?q=80&w=200' }}"
                        class="w-full h-24 object-cover rounded bg-gray-100">
                    <input type="file" name="image" class="text-xs text-gray-500 mt-2 w-full">
                </div>
                <div class="md:w-2/3 space-y-2">
                    <input type="text" name="title"
                        class="input-pool w-full border-gray-300 rounded text-sm font-bold"
                        value="{{ old('title', $slot4->title ?? 'Fasilitas Modern & Bersih') }}" placeholder="Judul">
                    <textarea name="description" rows="2" class="input-pool w-full border-gray-300 rounded text-xs text-gray-600"
                        placeholder="Deskripsi">{{ old('description', $slot4->description ?? 'Ruang ganti premium, shower air hangat, dan locker room.') }}</textarea>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
