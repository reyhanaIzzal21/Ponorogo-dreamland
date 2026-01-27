<div x-data="{ open: false }" x-on:open-modal.window="if ($event.detail === 'add-photo-{{ $stage->id }}') open = true">
    <div x-show="open" class="fixed inset-0 z-80 flex items-center justify-center bg-black/50" x-transition.opacity>
        <div class="bg-white p-6 rounded-lg shadow-xl w-96 relative" @click.away="open = false">
            <h3 class="text-lg font-bold mb-4">Upload Foto Progres</h3>
            <form action="{{ route('admin.pool.timeline.photos.store', $stage->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="file" name="image"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-4">
                <div class="flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 text-gray-500 hover:bg-gray-100 rounded">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
