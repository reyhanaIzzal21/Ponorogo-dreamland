<div x-show="activeTab === 'timeline'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
        <div>
            <h2 class="text-lg md:text-xl font-bold text-gray-800">Progress Tracker</h2>
            <p class="text-gray-500 text-xs md:text-sm">Update tahapan pembangunan secara transparan.</p>
        </div>
        <button @click="$dispatch('open-modal', 'add-stage-modal')"
            class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3 py-2 rounded-lg flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                </path>
            </svg>
            Tambah Tahap
        </button>
    </div>

    <div class="space-y-6">
        @foreach ($timelineStages as $stage)
            <div
                class="border border-gray-200 rounded-xl p-5 bg-white relative transition hover:border-blue-300 shadow-sm">

                <form action="{{ route('admin.pool.timeline.destroy', $stage->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus tahap ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="absolute top-3 right-3 text-red-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H6a1 1 0 01-1-1V5h14v1a1 1 0 01-1 1h-3z">
                            </path>
                        </svg>
                    </button>
                </form>

                <form action="{{ route('admin.pool.timeline.update', $stage->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Judul
                                    Tahap</label>
                                <input type="text" name="title"
                                    class="input-pool w-full border-b border-gray-200 focus:border-blue-500 font-bold text-gray-800 p-1 border-t-0 border-x-0 focus:ring-0"
                                    value="{{ old('title', $stage->title) }}">
                            </div>
                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Periode</label>
                                    <input type="text" name="period"
                                        class="input-pool w-full border-b border-gray-200 focus:border-blue-500 text-sm text-gray-600 p-1 border-t-0 border-x-0 focus:ring-0"
                                        value="{{ old('period', $stage->period) }}">
                                </div>
                                <div class="w-1/2">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Status</label>
                                    <select name="status"
                                        class="input-pool w-full border-gray-200 rounded text-sm p-1 bg-gray-50 focus:ring-blue-500">
                                        <option value="done" {{ $stage->status == 'done' ? 'selected' : '' }}>✅ Done
                                            (Selesai)</option>
                                        <option value="on_progress"
                                            {{ $stage->status == 'on_progress' ? 'selected' : '' }}>🚧 On Progress
                                        </option>
                                        <option value="planned" {{ $stage->status == 'planned' ? 'selected' : '' }}>📅
                                            Planned</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Deskripsi</label>
                                <textarea name="description" rows="2"
                                    class="input-pool w-full border-gray-200 rounded text-sm p-2 bg-gray-50 focus:ring-blue-500">{{ old('description', $stage->description) }}</textarea>
                            </div>
                            <div class="pt-2">
                                <button type="submit"
                                    class="bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">Simpan
                                    Perubahan</button>
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 rounded-lg p-4 border border-dashed border-gray-300 flex flex-col justify-center">

                            @if ($stage->status == 'on_progress')
                                {{-- ON PROGRESS: Editable --}}
                                <div class="space-y-4" x-data="{ progress: {{ $stage->progress_percentage }} }">
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <label class="text-xs font-bold text-blue-700">Persentase
                                                Progres</label>
                                            <span class="text-xs font-bold text-blue-700"
                                                x-text="progress + '%'">{{ $stage->progress_percentage }}%</span>
                                        </div>
                                        <input type="range" name="progress_percentage" min="0" max="100"
                                            x-model="progress"
                                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                    </div>

                                    {{-- Photos Management --}}
                                    <div>
                                        <label class="text-xs font-bold text-gray-500 mb-2 block">Foto Progres (Max
                                            3)</label>
                                        <div class="flex gap-2">
                                            @foreach ($stage->photos as $photo)
                                                <div
                                                    class="relative w-16 h-16 bg-gray-200 rounded text-xs border border-gray-300 group-photo">
                                                    <img src="{{ asset('storage/' . $photo->image_path) }}"
                                                        class="w-full h-full object-cover rounded">
                                                    <button type="submit" form="delete-photo-{{ $photo->id }}"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs opacity-0 group-photo-hover:opacity-100">&times;</button>
                                                </div>
                                            @endforeach

                                            @if ($stage->photos->count() < 3)
                                                <button type="button"
                                                    @click="$dispatch('open-modal', 'add-photo-{{ $stage->id }}')"
                                                    class="w-16 h-16 bg-white border-2 border-dashed border-blue-300 rounded flex items-center justify-center text-blue-500 cursor-pointer hover:bg-blue-50">
                                                    <span class="text-xl">+</span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @elseif($stage->status == 'done')
                                {{-- DONE: Badge Only --}}
                                <div class="text-center py-6">
                                    <input type="hidden" name="progress_percentage" value="100">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-3">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-gray-800">Proyek Selesai</h4>
                                    <p class="text-xs text-gray-500 mb-4">Progress 100%</p>

                                    @if ($stage->photos->count() > 0)
                                        <div class="flex justify-center gap-2 mt-2">
                                            @foreach ($stage->photos as $photo)
                                                <div
                                                    class="w-10 h-10 bg-gray-200 rounded overflow-hidden border border-gray-300">
                                                    <img src="{{ asset('storage/' . $photo->image_path) }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @else
                                {{-- PLANNED: Badge Only --}}
                                <div class="text-center py-6">
                                    <input type="hidden" name="progress_percentage" value="0">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-500 mb-3">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-gray-800">Tahap Direncanakan</h4>
                                    <p class="text-xs text-gray-500">Belum dimulai (0%)</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>

                {{-- Hidden Delete Photo Forms --}}
                @foreach ($stage->photos as $photo)
                    <form id="delete-photo-{{ $photo->id }}"
                        action="{{ route('admin.pool.timeline.photos.destroy', $photo->id) }}" method="POST"
                        class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

                {{-- Add Photo Modal (Simplified as inline or another modal) --}}
                <!-- We'll implement a simple file input in the Update form or a separate small form.
                     Actually, separate form for adding photo is cleaner.
                     I'll make the "+" button trigger a hidden file input or a small modal.
                     For simplicity, let's use a hidden form with file input triggered by JS/Alpine.
                -->
                @include('admin.pages.pool.modals.add-photo')

            </div>
        @endforeach
    </div>

    {{-- Add Stage Modal --}}
    @include('admin.pages.pool.modals.add-stage')
</div>
<style>
    .group-photo:hover .group-photo-hover\:opacity-100 {
        opacity: 1;
    }
</style>
