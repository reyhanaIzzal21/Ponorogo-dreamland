<!-- Overlay -->
<div id="modal-delete" class="fixed inset-0 z-1000 hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm">
    <!-- Modal Box -->
    <div class="w-full max-w-sm rounded-2xl bg-white p-6 text-center shadow-2xl">
        <!-- Icon -->
        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <!-- Title -->
        <h3 class="mb-2 text-lg font-bold text-slate-800">
            Hapus Data?
        </h3>

        <!-- Description -->
        <p id="deleteModalText" class="mb-6 text-sm text-slate-500">
            Apakah anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
        </p>

        <!-- Actions -->
        <div class="flex justify-center gap-3">
            <button type="button" onclick="closeDeleteModal()"
                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 font-medium text-slate-700 transition hover:bg-slate-50">
                Batal
            </button>

            <form id="deleteForm" method="POST" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full rounded-lg bg-red-600 px-4 py-2 font-medium text-white shadow-md shadow-red-500/20 transition hover:bg-red-700">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl, description = null) {
        const modal = document.getElementById('modal-delete');
        const form = document.getElementById('deleteForm');
        const text = document.getElementById('deleteModalText');

        form.action = actionUrl;

        if (description) {
            text.innerHTML = description;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('modal-delete');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

{{-- <button type="button"
    onclick="openDeleteModal(
                                    '{{ route('categories.destroy', $category->id) }}',
                                    'Apakah anda yakin ingin menghapus <strong>{{ $category->name }}</strong>? Tindakan ini tidak dapat dibatalkan.')"
    class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition border border-red-100 text-sm font-medium">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
    Delete
</button> --}}
