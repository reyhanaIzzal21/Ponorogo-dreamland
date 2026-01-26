<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('restaurantCMS', () => ({
            activeTab: 'hero',
            loading: false,
            showToast: false,
            toastMessage: '',
            toastType: 'success',

            // Menu data from server
            menus: @json($menuItems ?? []),

            // Best seller slots
            slot1: '{{ $bestSellers->where('slot_number', 1)->first()?->menu_item_id ?? '' }}',
            slot2: '{{ $bestSellers->where('slot_number', 2)->first()?->menu_item_id ?? '' }}',
            slot3: '{{ $bestSellers->where('slot_number', 3)->first()?->menu_item_id ?? '' }}',

            // Helper to get menu object by ID
            getMenu(id) {
                return this.menus.find(m => m.id == id) || {
                    name: 'Pilih Menu',
                    price: '-',
                    image_url: ''
                };
            },

            // Show toast notification
            toast(message, type = 'success') {
                this.toastMessage = message;
                this.toastType = type;
                this.showToast = true;
                setTimeout(() => this.showToast = false, 3000);
            },

            // Submit form via AJAX
            async submitForm(formId, url, method = 'PUT') {
                this.loading = true;
                const form = document.getElementById(formId);
                const formData = new FormData(form);
                formData.append('_method', method);

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.toast(data.message, 'success');
                    } else {
                        this.toast(data.message || 'Terjadi kesalahan', 'error');
                    }
                } catch (error) {
                    this.toast('Terjadi kesalahan koneksi', 'error');
                    console.error(error);
                } finally {
                    this.loading = false;
                }
            },

            // Save best sellers
            async saveBestSellers() {
                this.loading = true;
                const formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('slot1', this.slot1);
                formData.append('slot2', this.slot2);
                formData.append('slot3', this.slot3);

                try {
                    const response = await fetch(
                        '{{ route('admin.restaurant.best-sellers.update') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        });

                    const data = await response.json();

                    if (data.success) {
                        this.toast(data.message, 'success');
                    } else {
                        this.toast(data.message || 'Terjadi kesalahan', 'error');
                    }
                } catch (error) {
                    this.toast('Terjadi kesalahan koneksi', 'error');
                    console.error(error);
                } finally {
                    this.loading = false;
                }
            },

            // Upload gallery image
            async uploadGalleryImage(event) {
                const file = event.target.files[0];
                if (!file) return;

                this.loading = true;
                const formData = new FormData();
                formData.append('image', file);

                try {
                    const response = await fetch(
                        '{{ route('admin.restaurant.gallery.store') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        });

                    const data = await response.json();

                    if (data.success) {
                        this.toast(data.message, 'success');
                        // Reload page to show new image
                        window.location.reload();
                    } else {
                        this.toast(data.message || 'Terjadi kesalahan', 'error');
                    }
                } catch (error) {
                    this.toast('Terjadi kesalahan koneksi', 'error');
                    console.error(error);
                } finally {
                    this.loading = false;
                    event.target.value = '';
                }
            },

            // Delete gallery image
            async deleteGalleryImage(imageId) {
                if (!confirm('Hapus gambar ini?')) return;

                this.loading = true;
                try {
                    const response = await fetch(`/admin/restaurant/gallery/${imageId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.toast(data.message, 'success');
                        window.location.reload();
                    } else {
                        this.toast(data.message || 'Terjadi kesalahan', 'error');
                    }
                } catch (error) {
                    this.toast('Terjadi kesalahan koneksi', 'error');
                    console.error(error);
                } finally {
                    this.loading = false;
                }
            }
        }))
    })
</script>
