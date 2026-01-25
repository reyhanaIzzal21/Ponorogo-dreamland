<?php

namespace App\Services;

use App\Contracts\Interfaces\MenuCategoryRepositoryInterface;
use App\Contracts\Interfaces\MenuItemRepositoryInterface;
use App\Contracts\Interfaces\MenuPriceGroupRepositoryInterface;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\MenuPriceGroup;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuService
{
    /**
     * Cache TTL in seconds (5 minutes)
     */
    protected const CACHE_TTL = 300;

    /**
     * Cache key for active categories with items
     */
    protected const CACHE_KEY_CATEGORIES = 'menu:categories:active';

    public function __construct(
        protected MenuCategoryRepositoryInterface $categoryRepository,
        protected MenuItemRepositoryInterface $itemRepository,
        protected MenuPriceGroupRepositoryInterface $priceGroupRepository
    ) {}

    // =========================================================================
    // SLUG GENERATION (Auto-generate with duplicate handling)
    // =========================================================================

    /**
     * Generate unique slug from name.
     * If slug exists, append -1, -2, etc.
     *
     * @param string $name
     * @param string $model Class name (MenuCategory::class, MenuItem::class, etc.)
     * @param string|null $excludeId Exclude this ID when checking duplicates (for updates)
     * @return string
     */
    public function generateUniqueSlug(string $name, string $model, ?string $excludeId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while ($this->slugExists($slug, $model, $excludeId)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Check if slug exists in the given model.
     *
     * @param string $slug
     * @param string $model
     * @param string|null $excludeId
     * @return bool
     */
    protected function slugExists(string $slug, string $model, ?string $excludeId = null): bool
    {
        $query = $model::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    // =========================================================================
    // FILE UPLOAD (Handled in Service, not Controller)
    // =========================================================================

    /**
     * Upload image file to storage.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string Path to stored file
     */
    public function uploadImage(UploadedFile $file, string $directory = 'menu-items'): string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Delete image file from storage.
     *
     * @param string|null $path
     * @return bool
     */
    public function deleteImage(?string $path): bool
    {
        if (!$path || filter_var($path, FILTER_VALIDATE_URL)) {
            return false;
        }

        return Storage::disk('public')->delete($path);
    }

    // =========================================================================
    // PUBLIC (User-Facing) METHODS
    // =========================================================================

    /**
     * Get all active categories with items for user display.
     * Uses caching for performance.
     *
     * @return Collection
     */
    public function getAllCategoriesWithItems(): Collection
    {
        return Cache::remember(
            self::CACHE_KEY_CATEGORIES,
            self::CACHE_TTL,
            fn() => $this->categoryRepository->getActiveWithItems()
        );
    }

    /**
     * Get single category with items for display.
     *
     * @param string $slug
     * @return MenuCategory|null
     */
    public function getCategoryBySlug(string $slug): ?MenuCategory
    {
        $category = $this->categoryRepository->findBySlug($slug);

        if ($category) {
            $category->load(['items.packageContents', 'priceGroups.items']);
        }

        return $category;
    }

    /**
     * Get paginated items for a category (for lazy loading).
     *
     * @param string $categoryId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getCategoryItemsPaginated(string $categoryId, int $perPage = 12): LengthAwarePaginator
    {
        return $this->itemRepository->getByCategoryIdPaginated($categoryId, $perPage);
    }

    // =========================================================================
    // ADMIN CATEGORY METHODS
    // =========================================================================

    /**
     * Get all categories for admin listing.
     *
     * @return Collection
     */
    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Create a new category.
     *
     * @param array $data
     * @return MenuCategory
     */
    public function createCategory(array $data): MenuCategory
    {
        // Auto-generate unique slug from name
        $data['slug'] = $this->generateUniqueSlug($data['name'], MenuCategory::class);

        $category = $this->categoryRepository->create($data);
        $this->clearCache();

        return $category;
    }

    /**
     * Update a category.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function updateCategory(string $id, array $data): bool
    {
        // Auto-generate unique slug from name (excluding current ID)
        $data['slug'] = $this->generateUniqueSlug($data['name'], MenuCategory::class, $id);

        $result = $this->categoryRepository->update($id, $data);
        $this->clearCache();

        return $result;
    }

    /**
     * Delete a category.
     *
     * @param string $id
     * @return bool
     */
    public function deleteCategory(string $id): bool
    {
        $result = $this->categoryRepository->delete($id);
        $this->clearCache();

        return $result;
    }

    /**
     * Reorder categories.
     *
     * @param array $orderedIds
     * @return void
     */
    public function reorderCategories(array $orderedIds): void
    {
        $this->categoryRepository->reorder($orderedIds);
        $this->clearCache();
    }

    /**
     * Get category by ID.
     *
     * @param string $id
     * @return MenuCategory|null
     */
    public function getCategoryById(string $id): ?MenuCategory
    {
        return $this->categoryRepository->findById($id);
    }

    // =========================================================================
    // ADMIN MENU ITEM METHODS
    // =========================================================================

    /**
     * Get items for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getItemsByCategory(string $categoryId): Collection
    {
        return $this->itemRepository->getByCategoryId($categoryId);
    }

    /**
     * Get menu item by ID.
     *
     * @param string $id
     * @return MenuItem|null
     */
    public function getItemById(string $id): ?MenuItem
    {
        return $this->itemRepository->findByIdWithContents($id);
    }

    /**
     * Create a new menu item.
     *
     * @param array $data
     * @param UploadedFile|null $image
     * @param array $packageContents
     * @return MenuItem
     */
    public function createMenuItem(array $data, ?UploadedFile $image = null, array $packageContents = []): MenuItem
    {
        // Auto-generate unique slug from name
        $data['slug'] = $this->generateUniqueSlug($data['name'], MenuItem::class);

        // Handle image upload in Service
        if ($image) {
            $data['image_path'] = $this->uploadImage($image);
        }

        $item = $this->itemRepository->create($data);

        // Sync package contents if provided
        if (!empty($packageContents)) {
            $this->itemRepository->syncPackageContents($item->id, $packageContents);
        }

        $this->clearCache();

        return $item->fresh('packageContents');
    }

    /**
     * Update a menu item.
     *
     * @param string $id
     * @param array $data
     * @param UploadedFile|null $image
     * @param array|null $packageContents Package contents (null = don't update)
     * @return bool
     */
    public function updateMenuItem(string $id, array $data, ?UploadedFile $image = null, ?array $packageContents = null): bool
    {
        // Auto-generate unique slug from name (excluding current ID)
        $data['slug'] = $this->generateUniqueSlug($data['name'], MenuItem::class, $id);

        // Handle image upload in Service
        if ($image) {
            // Delete old image first
            $oldItem = $this->getItemById($id);
            if ($oldItem) {
                $this->deleteImage($oldItem->image_path);
            }

            $data['image_path'] = $this->uploadImage($image);
        }

        $result = $this->itemRepository->update($id, $data);

        // Sync package contents if provided
        if ($packageContents !== null) {
            $this->itemRepository->syncPackageContents($id, $packageContents);
        }

        $this->clearCache();

        return $result;
    }

    /**
     * Delete a menu item.
     *
     * @param string $id
     * @return bool
     */
    public function deleteMenuItem(string $id): bool
    {
        // Delete image first
        $item = $this->getItemById($id);
        if ($item) {
            $this->deleteImage($item->image_path);
        }

        $result = $this->itemRepository->delete($id);
        $this->clearCache();

        return $result;
    }

    /**
     * Reorder menu items.
     *
     * @param array $orderedIds
     * @return void
     */
    public function reorderItems(array $orderedIds): void
    {
        $this->itemRepository->reorder($orderedIds);
        $this->clearCache();
    }

    // =========================================================================
    // ADMIN PRICE GROUP METHODS
    // =========================================================================

    /**
     * Get price groups for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getPriceGroupsByCategory(string $categoryId): Collection
    {
        return $this->priceGroupRepository->getByCategoryIdWithItems($categoryId);
    }

    /**
     * Get price group by ID.
     *
     * @param string $id
     * @return MenuPriceGroup|null
     */
    public function getPriceGroupById(string $id): ?MenuPriceGroup
    {
        return $this->priceGroupRepository->findByIdWithItems($id);
    }

    /**
     * Create a new price group.
     *
     * @param array $data
     * @param array $items Item names
     * @return MenuPriceGroup
     */
    public function createPriceGroup(array $data, array $items = []): MenuPriceGroup
    {
        $group = $this->priceGroupRepository->create($data);

        if (!empty($items)) {
            $this->priceGroupRepository->syncItems($group->id, $items);
        }

        $this->clearCache();

        return $group->fresh('items');
    }

    /**
     * Update a price group.
     *
     * @param string $id
     * @param array $data
     * @param array|null $items Item names (null = don't update)
     * @return bool
     */
    public function updatePriceGroup(string $id, array $data, ?array $items = null): bool
    {
        $result = $this->priceGroupRepository->update($id, $data);

        if ($items !== null) {
            $this->priceGroupRepository->syncItems($id, $items);
        }

        $this->clearCache();

        return $result;
    }

    /**
     * Delete a price group.
     *
     * @param string $id
     * @return bool
     */
    public function deletePriceGroup(string $id): bool
    {
        $result = $this->priceGroupRepository->delete($id);
        $this->clearCache();

        return $result;
    }

    /**
     * Add item to price group.
     *
     * @param string $groupId
     * @param string $itemName
     * @return void
     */
    public function addPriceGroupItem(string $groupId, string $itemName): void
    {
        $this->priceGroupRepository->addItem($groupId, $itemName);
        $this->clearCache();
    }

    /**
     * Remove item from price group.
     *
     * @param string $itemId
     * @return bool
     */
    public function removePriceGroupItem(string $itemId): bool
    {
        $result = $this->priceGroupRepository->removeItem($itemId);
        $this->clearCache();

        return $result;
    }

    /**
     * Reorder price groups.
     *
     * @param array $orderedIds
     * @return void
     */
    public function reorderPriceGroups(array $orderedIds): void
    {
        $this->priceGroupRepository->reorder($orderedIds);
        $this->clearCache();
    }

    // =========================================================================
    // CACHE MANAGEMENT
    // =========================================================================

    /**
     * Clear menu cache.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY_CATEGORIES);
    }
}
