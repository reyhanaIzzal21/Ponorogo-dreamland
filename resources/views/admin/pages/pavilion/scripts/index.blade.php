<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pendopoCMS', () => ({
            activeTab: 'hero',
            saving: false,
            message: '',
            messageType: 'success',

            // Hero Section Data
            hero: {
                title: @json($heroSection?->title ?? ''),
                highlightedTitle: @json($heroSection?->getExtraValue('highlighted_title') ?? ''),
                description: @json($heroSection?->description ?? ''),
                backgroundImage: @json(
                    $heroSection?->background_image
                        ? (str_starts_with($heroSection->background_image, 'http')
                            ? $heroSection->background_image
                            : asset('storage/' . $heroSection->background_image))
                        : ''),
            },

            // Specs Section Data
            specsTitle: @json($specsSection?->title ?? 'Spesifikasi Venue'),
            specsSubtitle: @json($specsSection?->subtitle ?? ''),
            specs: @json($specsSection?->specs_items ?? []),

            // Facilities Section Data
            facilitiesTitle: @json($facilitiesSection?->title ?? 'Segala yang Anda Butuhkan'),
            facilitiesDescription: @json($facilitiesSection?->description ?? ''),
            @php
                $facilitiesImagePath = $facilitiesSection?->image_path;
                $facilitiesImageUrl = $facilitiesImagePath ? (str_starts_with($facilitiesImagePath, 'http') ? $facilitiesImagePath : asset('storage/' . $facilitiesImagePath)) : '';
            @endphp
            facilitiesImage: @json($facilitiesImageUrl),
            @php
                $facilitiesData = $facilities
                    ? $facilities
                        ->map(function ($f) {
                            return ['id' => $f->id, 'icon' => $f->icon, 'title' => $f->title, 'desc' => $f->description];
                        })
                        ->toArray()
                    : [];
            @endphp
            facilities: @json($facilitiesData),

            // Flexibility/Layout Data
            @php
                $layoutsData = $layouts
                    ? $layouts
                        ->map(function ($l) {
                            return [
                                'id' => $l->id,
                                'title' => $l->title,
                                'image' => str_starts_with($l->image_path, 'http') ? $l->image_path : asset('storage/' . $l->image_path),
                            ];
                        })
                        ->toArray()
                    : [];
            @endphp
            flexibility: @json($layoutsData),

            // Specs Actions
            addSpec() {
                if (this.specs.length < 4) {
                    this.specs.push({
                        title: 'Baru',
                        desc: '...'
                    });
                }
            },
            removeSpec(index) {
                this.specs.splice(index, 1);
            },

            // Facilities Actions
            addFacility() {
                this.facilities.push({
                    icon: '✨',
                    title: '',
                    desc: ''
                });
            },
            removeFacility(index) {
                this.facilities.splice(index, 1);
            },

            // Flexibility Actions
            addFlexibility() {
                document.getElementById('layout-upload-input').click();
            },
            removeFlexibility(index) {
                const layout = this.flexibility[index];
                if (layout.id) {
                    this.deleteLayout(layout.id, index);
                } else {
                    this.flexibility.splice(index, 1);
                }
            },

            // Upload Facilities Section Image
            async uploadFacilitiesImage(event) {
                const file = event.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('image', file);

                try {
                    const response = await fetch(
                        '{{ route('admin.pavilion.facilities.image') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                    const data = await response.json();
                    if (data.success) {
                        this.facilitiesImage = data.image_url;
                        this.showMessage('Gambar fasilitas berhasil diupload!', 'success');
                    } else {
                        this.showMessage(data.message || 'Gagal upload gambar', 'error');
                    }
                } catch (error) {
                    this.showMessage('Terjadi kesalahan saat upload', 'error');
                }

                event.target.value = '';
            },

            // Upload Layout Image
            async uploadLayoutImage(event) {
                const file = event.target.files[0];
                if (!file) return;

                const title = prompt('Masukkan nama layout:', 'Layout Baru');
                if (!title) return;

                const formData = new FormData();
                formData.append('image', file);
                formData.append('title', title);

                try {
                    const response = await fetch(
                        '{{ route('admin.pavilion.layouts.store') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                    const data = await response.json();
                    if (data.success) {
                        this.flexibility.push({
                            id: data.layout.id,
                            title: data.layout.title,
                            image: data.layout.image_url
                        });
                        this.showMessage('Layout berhasil diupload!', 'success');
                    } else {
                        this.showMessage(data.message || 'Gagal upload layout', 'error');
                    }
                } catch (error) {
                    this.showMessage('Terjadi kesalahan saat upload', 'error');
                }

                event.target.value = '';
            },

            // Delete Layout
            async deleteLayout(id, index) {
                if (!confirm('Hapus layout ini?')) return;

                try {
                    const response = await fetch(`{{ url('admin/pavilion/layouts') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();
                    if (data.success) {
                        this.flexibility.splice(index, 1);
                        this.showMessage('Layout berhasil dihapus!', 'success');
                    } else {
                        this.showMessage(data.message || 'Gagal menghapus layout', 'error');
                    }
                } catch (error) {
                    this.showMessage('Terjadi kesalahan', 'error');
                }
            },

            // Save All Data
            async saveAll() {
                this.saving = true;

                try {
                    const response = await fetch('{{ route('admin.pavilion.save-all') }}', {
                        method: 'POST',
                        body: JSON.stringify({
                            hero: {
                                title: this.hero.title,
                                highlighted_title: this.hero.highlightedTitle,
                                description: this.hero.description
                            },
                            specs: {
                                title: this.specsTitle,
                                subtitle: this.specsSubtitle,
                                items: this.specs
                            },
                            facilities: {
                                title: this.facilitiesTitle,
                                description: this.facilitiesDescription,
                                items: this.facilities
                            },
                            layouts: this.flexibility.filter(l => l.id).map(l =>
                                ({
                                    id: l.id,
                                    title: l.title
                                }))
                        }),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();
                    if (data.success) {
                        this.showMessage('Semua perubahan berhasil disimpan!', 'success');
                    } else {
                        this.showMessage(data.message || 'Gagal menyimpan', 'error');
                    }
                } catch (error) {
                    this.showMessage('Terjadi kesalahan saat menyimpan', 'error');
                }

                this.saving = false;
            },

            // Upload Hero Background
            async uploadHeroBackground(event) {
                const file = event.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('background_image', file);
                formData.append('title', this.hero.title);
                formData.append('highlighted_title', this.hero.highlightedTitle);
                formData.append('description', this.hero.description);

                try {
                    const response = await fetch('{{ route('admin.pavilion.hero.update') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();
                    if (data.success) {
                        this.showMessage('Background berhasil diupload!', 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        this.showMessage(data.message || 'Gagal upload', 'error');
                    }
                } catch (error) {
                    this.showMessage('Terjadi kesalahan saat upload', 'error');
                }
            },

            // Show Message
            showMessage(text, type = 'success') {
                this.message = text;
                this.messageType = type;
                setTimeout(() => this.message = '', 3000);
            }
        }))
    })
</script>
