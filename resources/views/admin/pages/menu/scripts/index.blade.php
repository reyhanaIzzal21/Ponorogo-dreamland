<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('menuCMS', () => ({
            // State
            categories: @json($categories ?? []),
            categoryTypes: @json($types ?? []),
            activeCatId: null,
            currentCategory: null,
            categoryItems: [],
            priceGroups: [],
            isLoading: false,
            isSubmitting: false,
            formError: null,

            // Modal States
            isCategoryModalOpen: false,
            isItemModalOpen: false,
            isDeleteModalOpen: false,
            isPriceGroupModalOpen: false,

            // Edit States
            editingCategory: null,
            editingItem: null,
            editingPriceGroup: null,

            // Form Data
            categoryForm: {
                name: '',
                type: 'grid-photo',
                icon: '',
                is_active: true
            },
            itemForm: {
                name: '',
                price: '',
                price_suffix: '',
                description: '',
                image: null,
                image_path: '',
                is_promo: false,
                promo_badge: '',
                is_active: true,
                package_contents: []
            },
            priceGroupForm: {
                price: '',
                is_active: true,
                items: []
            },
            imagePreview: null,

            // Delete State
            deleteTarget: null,
            deleteType: null,
            deleteMessage: '',

            // Initialization
            init() {
                if (this.categories.length > 0) {
                    this.setActiveCategory(this.categories[0].id);
                }
            },

            // Helper Methods
            getTypeLabel(type) {
                return this.categoryTypes[type] || type;
            },

            // Get proper image URL (handle local storage vs external URL)
            getImageUrl(item) {
                if (!item.image_path) return '/images/placeholder-food.jpg';

                // Check if it's already a full URL
                if (item.image_path.startsWith('http://') || item.image_path.startsWith(
                        'https://')) {
                    return item.image_path;
                }

                // For local storage, prepend /storage/
                return '/storage/' + item.image_path;
            },

            // Format price to Indonesian Rupiah
            formatPrice(price) {
                if (!price && price !== 0) return 'Rp 0';
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
            },

            // Category Methods
            async setActiveCategory(categoryId) {
                this.activeCatId = categoryId;
                this.currentCategory = this.categories.find(c => c.id === categoryId);
                this.isLoading = true;

                try {
                    if (this.currentCategory?.type === 'price-group') {
                        await this.loadPriceGroups(categoryId);
                    } else {
                        await this.loadItems(categoryId);
                    }
                } catch (error) {
                    console.error('Error loading data:', error);
                } finally {
                    this.isLoading = false;
                }
            },

            async loadItems(categoryId) {
                const response = await fetch(`/admin/menu/items?category_id=${categoryId}`);
                const data = await response.json();
                this.categoryItems = data.data || [];
            },

            async loadPriceGroups(categoryId) {
                const response = await fetch(
                    `/admin/menu/price-groups?category_id=${categoryId}`);
                const data = await response.json();
                this.priceGroups = data.data || [];
            },

            // Category CRUD
            openCategoryModal() {
                this.editingCategory = null;
                this.categoryForm = {
                    name: '',
                    type: 'grid-photo',
                    icon: '',
                    is_active: true
                };
                this.formError = null;
                this.isCategoryModalOpen = true;
            },

            editCategory(category) {
                this.editingCategory = category;
                this.categoryForm = {
                    name: category.name,
                    type: category.type,
                    icon: category.icon || '',
                    is_active: category.is_active
                };
                this.formError = null;
                this.isCategoryModalOpen = true;
            },

            closeCategoryModal() {
                this.isCategoryModalOpen = false;
                this.editingCategory = null;
            },

            async saveCategory() {
                this.isSubmitting = true;
                this.formError = null;

                try {
                    const url = this.editingCategory ?
                        `/admin/menu/categories/${this.editingCategory.id}` :
                        '/admin/menu/categories';
                    const method = this.editingCategory ? 'PUT' : 'POST';

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.categoryForm)
                    });

                    const data = await response.json();

                    if (data.success) {
                        window.location.reload();
                    } else {
                        this.formError = data.message || 'Terjadi kesalahan';
                    }
                } catch (error) {
                    this.formError = 'Terjadi kesalahan jaringan';
                } finally {
                    this.isSubmitting = false;
                }
            },

            // Item CRUD
            openItemModal() {
                this.editingItem = null;
                this.itemForm = {
                    name: '',
                    price: '',
                    price_suffix: '',
                    description: '',
                    image: null,
                    image_path: '',
                    is_promo: false,
                    promo_badge: '',
                    is_active: true,
                    package_contents: []
                };
                this.imagePreview = null;
                this.formError = null;
                this.isItemModalOpen = true;
            },

            editItem(item) {
                this.editingItem = item;
                this.itemForm = {
                    name: item.name,
                    price: item.price,
                    price_suffix: item.price_suffix || '',
                    description: item.description || '',
                    image: null,
                    image_path: this.getImageUrl(item),
                    is_promo: item.is_promo,
                    promo_badge: item.promo_badge || '',
                    is_active: item.is_active,
                    package_contents: item.package_contents?.map(c => c.content_name) || []
                };
                this.imagePreview = null;
                this.formError = null;
                this.isItemModalOpen = true;
            },

            closeItemModal() {
                this.isItemModalOpen = false;
                this.editingItem = null;
            },

            handleImageUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.itemForm.image = file;
                    this.imagePreview = URL.createObjectURL(file);
                }
            },

            addPackageContent(content) {
                if (content.trim()) {
                    this.itemForm.package_contents.push(content.trim());
                }
            },

            removePackageContent(index) {
                this.itemForm.package_contents.splice(index, 1);
            },

            async saveItem() {
                this.isSubmitting = true;
                this.formError = null;

                try {
                    const formData = new FormData();
                    formData.append('menu_category_id', this.currentCategory.id);
                    formData.append('name', this.itemForm.name);
                    formData.append('price', this.itemForm.price);
                    formData.append('price_suffix', this.itemForm.price_suffix || '');
                    formData.append('description', this.itemForm.description || '');
                    formData.append('is_promo', this.itemForm.is_promo ? '1' : '0');
                    formData.append('promo_badge', this.itemForm.promo_badge || '');
                    formData.append('is_active', this.itemForm.is_active ? '1' : '0');

                    if (this.itemForm.image) {
                        formData.append('image', this.itemForm.image);
                    }

                    this.itemForm.package_contents.forEach((content, index) => {
                        formData.append(`package_contents[${index}]`, content);
                    });

                    const url = this.editingItem ?
                        `/admin/menu/items/${this.editingItem.id}` :
                        '/admin/menu/items';

                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.closeItemModal();
                        await this.loadItems(this.currentCategory.id);
                    } else {
                        this.formError = data.message || 'Terjadi kesalahan';
                    }
                } catch (error) {
                    this.formError = 'Terjadi kesalahan jaringan';
                } finally {
                    this.isSubmitting = false;
                }
            },

            // Delete Operations
            confirmDelete(item) {
                this.deleteTarget = item;
                this.deleteType = 'item';
                this.deleteMessage = `Hapus item "${item.name}"?`;
                this.isDeleteModalOpen = true;
            },

            confirmDeleteCategory(category) {
                this.deleteTarget = category;
                this.deleteType = 'category';
                this.deleteMessage = `Hapus kategori "${category.name}" beserta semua isinya?`;
                this.isDeleteModalOpen = true;
            },

            confirmDeletePriceGroup(group) {
                this.deleteTarget = group;
                this.deleteType = 'priceGroup';
                this.deleteMessage = `Hapus price group "Serba ${this.formatPrice(group.price)}"?`;
                this.isDeleteModalOpen = true;
            },

            async executeDelete() {
                this.isSubmitting = true;

                try {
                    let url;
                    if (this.deleteType === 'category') {
                        url = `/admin/menu/categories/${this.deleteTarget.id}`;
                    } else if (this.deleteType === 'item') {
                        url = `/admin/menu/items/${this.deleteTarget.id}`;
                    } else if (this.deleteType === 'priceGroup') {
                        url = `/admin/menu/price-groups/${this.deleteTarget.id}`;
                    }

                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.isDeleteModalOpen = false;
                        if (this.deleteType === 'category') {
                            window.location.reload();
                        } else if (this.deleteType === 'item') {
                            await this.loadItems(this.currentCategory.id);
                        } else if (this.deleteType === 'priceGroup') {
                            await this.loadPriceGroups(this.currentCategory.id);
                        }
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                } finally {
                    this.isSubmitting = false;
                }
            },

            // Price Group Operations
            openPriceGroupModal() {
                this.editingPriceGroup = null;
                this.priceGroupForm = {
                    price: '',
                    is_active: true,
                    items: []
                };
                this.formError = null;
                this.isPriceGroupModalOpen = true;
            },

            editPriceGroup(group) {
                this.editingPriceGroup = group;
                this.priceGroupForm = {
                    price: group.price,
                    is_active: group.is_active,
                    items: group.items?.map(i => i.item_name) || []
                };
                this.formError = null;
                this.isPriceGroupModalOpen = true;
            },

            closePriceGroupModal() {
                this.isPriceGroupModalOpen = false;
                this.editingPriceGroup = null;
            },

            addPriceGroupFormItem(itemName) {
                if (itemName.trim()) {
                    this.priceGroupForm.items.push(itemName.trim());
                }
            },

            removePriceGroupFormItem(index) {
                this.priceGroupForm.items.splice(index, 1);
            },

            async savePriceGroup() {
                this.isSubmitting = true;
                this.formError = null;

                try {
                    const url = this.editingPriceGroup ?
                        `/admin/menu/price-groups/${this.editingPriceGroup.id}` :
                        '/admin/menu/price-groups';
                    const method = this.editingPriceGroup ? 'PUT' : 'POST';

                    const payload = {
                        menu_category_id: this.currentCategory.id,
                        price: this.priceGroupForm.price,
                        is_active: this.priceGroupForm.is_active,
                        items: this.priceGroupForm.items
                    };

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.closePriceGroupModal();
                        await this.loadPriceGroups(this.currentCategory.id);
                    } else {
                        this.formError = data.message || 'Terjadi kesalahan';
                    }
                } catch (error) {
                    this.formError = 'Terjadi kesalahan jaringan';
                } finally {
                    this.isSubmitting = false;
                }
            },

            async addPriceGroupItem(groupId, itemName) {
                if (!itemName.trim()) return;

                try {
                    const response = await fetch(`/admin/menu/price-groups/${groupId}/items`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            item_name: itemName
                        })
                    });

                    if (response.ok) {
                        await this.loadPriceGroups(this.currentCategory.id);
                    }
                } catch (error) {
                    console.error('Error adding item:', error);
                }
            },

            async removePriceGroupItem(itemId) {
                try {
                    const response = await fetch(`/admin/menu/price-groups/items/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        await this.loadPriceGroups(this.currentCategory.id);
                    }
                } catch (error) {
                    console.error('Error removing item:', error);
                }
            }
        }));
    });
</script>
