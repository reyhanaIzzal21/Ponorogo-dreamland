<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('destinationMaster', () => ({
            isModalOpen: false,
            isLoading: false,
            isSaving: false,
            modalMode: 'add', // 'add' or 'edit'

            // FORM MODEL
            form: {
                id: null,
                name: '',
                type: 'restaurant',
                status: 'open',
                description: '',
                cover_image: null
            },

            // Destinations data from server
            @php
                $destinationsData = $destinations->map(function ($d) {
                    return [
                        'id' => $d->id,
                        'name' => $d->name,
                        'slug' => $d->slug,
                        'description' => $d->description,
                        'type' => $d->type,
                        'type_label' => $d->type_label,
                        'status' => $d->status,
                        'status_label' => $d->status_label,
                        'cover_image' => $d->cover_image,
                        'cover_image_url' => $d->cover_image_url,
                        'sort_order' => $d->sort_order,
                        'is_active' => $d->is_active,
                        'can_be_reserved' => $d->canBeReserved(),
                        'updated_at' => $d->updated_at->diffForHumans(),
                    ];
                });
            @endphp
            destinations: @json($destinationsData),

            // ROUTES
            routes: {
                store: "{{ route('admin.destinations.store') }}",
                show: "{{ route('admin.destinations.show', ':id') }}",
                update: "{{ route('admin.destinations.update', ':id') }}",
                destroy: "{{ route('admin.destinations.destroy', ':id') }}"
            },

            // HELPER FUNCTIONS
            getStatusClass(status) {
                const classes = {
                    'open': 'status-open',
                    'closed': 'status-closed',
                    'soon': 'status-soon',
                    'maintenance': 'status-maintenance'
                };
                return classes[status] || 'bg-gray-100 text-gray-800';
            },

            getStatusLabel(status) {
                const labels = {
                    'open': '🟢 Open',
                    'closed': '🔴 Closed',
                    'soon': '🚧 Coming Soon',
                    'maintenance': '🔧 Maintenance'
                };
                return labels[status] || status;
            },

            openModal(mode, data = null) {
                this.modalMode = mode;
                if (mode === 'edit' && data) {
                    this.form = {
                        id: data.id,
                        name: data.name,
                        type: data.type,
                        status: data.status,
                        description: data.description || '',
                        cover_image: null
                    };
                } else {
                    this.form = {
                        id: null,
                        name: '',
                        type: 'restaurant',
                        status: 'open',
                        description: '',
                        cover_image: null
                    };
                }
                this.isModalOpen = true;
            },

            closeModal() {
                this.isModalOpen = false;
                this.form = {
                    id: null,
                    name: '',
                    type: 'restaurant',
                    status: 'open',
                    description: '',
                    cover_image: null
                };
            },

            handleImageChange(event) {
                const file = event.target.files[0];
                if (file) {
                    this.form.cover_image = file;
                }
            },

            async saveDestination() {
                this.isSaving = true;

                const formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('type', this.form.type);
                formData.append('status', this.form.status);
                formData.append('description', this.form.description || '');

                if (this.form.cover_image) {
                    formData.append('cover_image', this.form.cover_image);
                }

                try {
                    let url, method;

                    if (this.modalMode === 'add') {
                        url = this.routes.store;
                    } else {
                        url = this.routes.update.replace(':id', this.form.id);
                    }

                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (result.success) {
                        if (this.modalMode === 'add') {
                            this.destinations.push(result.data);
                        } else {
                            const index = this.destinations.findIndex(d => d.id === this.form
                                .id);
                            if (index !== -1) {
                                this.destinations[index] = result.data;
                            }
                        }
                        this.closeModal();
                        this.showNotification(result.message, 'success');
                    } else {
                        this.showNotification(result.message || 'Terjadi kesalahan', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.showNotification('Terjadi kesalahan saat menyimpan data', 'error');
                } finally {
                    this.isSaving = false;
                }
            },

            async confirmDelete(dest) {
                if (!confirm(`Apakah Anda yakin ingin menghapus "${dest.name}"?`)) {
                    return;
                }

                try {
                    const url = this.routes.destroy.replace(':id', dest.id);

                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        this.destinations = this.destinations.filter(d => d.id !== dest.id);
                        this.showNotification(result.message, 'success');
                    } else {
                        this.showNotification(result.message || 'Gagal menghapus destinasi',
                            'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.showNotification('Terjadi kesalahan saat menghapus data', 'error');
                }
            },

            showNotification(message, type = 'success') {
                // Simple alert for now, can be replaced with toast library
                if (type === 'success') {
                    alert('✅ ' + message);
                } else {
                    alert('❌ ' + message);
                }
            }
        }))
    })
</script>
