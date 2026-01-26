<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\MenuItemRepositoryInterface;
use App\Models\MenuItem;
use App\Models\MenuPackageContent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MenuItemRepository implements MenuItemRepositoryInterface
{
    /**
     * Get all active menu items.
     *
     * @return Collection
     */
    public function getAllActive(): Collection
    {
        return MenuItem::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    /**
     * Get all items for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getByCategoryId(string $categoryId): Collection
    {
        return MenuItem::where('menu_category_id', $categoryId)
            ->orderBy('sort_order')
            ->with('packageContents')
            ->get();
    }

    /**
     * Get items for a category with pagination (lazy loading).
     *
     * @param string $categoryId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByCategoryIdPaginated(string $categoryId, int $perPage = 10): LengthAwarePaginator
    {
        return MenuItem::where('menu_category_id', $categoryId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with('packageContents')
            ->paginate($perPage);
    }

    /**
     * Find item by ID.
     *
     * @param string $id
     * @return MenuItem|null
     */
    public function findById(string $id): ?MenuItem
    {
        return MenuItem::find($id);
    }

    /**
     * Find item by ID with package contents.
     *
     * @param string $id
     * @return MenuItem|null
     */
    public function findByIdWithContents(string $id): ?MenuItem
    {
        return MenuItem::with('packageContents')->find($id);
    }

    /**
     * Create a new menu item.
     *
     * @param array $data
     * @return MenuItem
     */
    public function create(array $data): MenuItem
    {
        // Auto-generate sort_order if not provided
        if (!isset($data['sort_order'])) {
            $maxOrder = MenuItem::where('menu_category_id', $data['menu_category_id'])
                ->max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return MenuItem::create($data);
    }

    /**
     * Update a menu item.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $item = $this->findById($id);

        if (!$item) {
            return false;
        }

        return $item->update($data);
    }

    /**
     * Delete a menu item.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $item = $this->findById($id);

        if (!$item) {
            return false;
        }

        return $item->delete();
    }

    /**
     * Sync package contents for an item.
     * Replaces all existing contents with new ones.
     *
     * @param string $itemId
     * @param array $contents Array of content names
     * @return void
     */
    public function syncPackageContents(string $itemId, array $contents): void
    {
        DB::transaction(function () use ($itemId, $contents) {
            // Delete existing contents
            MenuPackageContent::where('menu_item_id', $itemId)->delete();

            // Create new contents
            foreach ($contents as $index => $contentName) {
                if (trim($contentName) === '') {
                    continue;
                }

                MenuPackageContent::create([
                    'menu_item_id' => $itemId,
                    'content_name' => trim($contentName),
                    'sort_order' => $index + 1,
                ]);
            }
        });
    }

    /**
     * Reorder items within a category.
     *
     * @param array $orderedIds Array of IDs in desired order
     * @return void
     */
    public function reorder(array $orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            MenuItem::where('id', $id)->update(['sort_order' => $index + 1]);
        }
    }
}
