<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\MenuPriceGroupRepositoryInterface;
use App\Models\MenuPriceGroup;
use App\Models\MenuPriceGroupItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MenuPriceGroupRepository implements MenuPriceGroupRepositoryInterface
{
    /**
     * Get all price groups for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getByCategoryId(string $categoryId): Collection
    {
        return MenuPriceGroup::where('menu_category_id', $categoryId)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get price groups with items for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getByCategoryIdWithItems(string $categoryId): Collection
    {
        return MenuPriceGroup::where('menu_category_id', $categoryId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with('items')
            ->get();
    }

    /**
     * Find price group by ID.
     *
     * @param string $id
     * @return MenuPriceGroup|null
     */
    public function findById(string $id): ?MenuPriceGroup
    {
        return MenuPriceGroup::find($id);
    }

    /**
     * Find price group by ID with items.
     *
     * @param string $id
     * @return MenuPriceGroup|null
     */
    public function findByIdWithItems(string $id): ?MenuPriceGroup
    {
        return MenuPriceGroup::with('items')->find($id);
    }

    /**
     * Create a new price group.
     *
     * @param array $data
     * @return MenuPriceGroup
     */
    public function create(array $data): MenuPriceGroup
    {
        // Auto-generate sort_order if not provided
        if (!isset($data['sort_order'])) {
            $maxOrder = MenuPriceGroup::where('menu_category_id', $data['menu_category_id'])
                ->max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return MenuPriceGroup::create($data);
    }

    /**
     * Update a price group.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $group = $this->findById($id);

        if (!$group) {
            return false;
        }

        return $group->update($data);
    }

    /**
     * Delete a price group.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $group = $this->findById($id);

        if (!$group) {
            return false;
        }

        return $group->delete();
    }

    /**
     * Sync items for a price group.
     * Replaces all existing items with new ones.
     *
     * @param string $groupId
     * @param array $itemNames Array of item names
     * @return void
     */
    public function syncItems(string $groupId, array $itemNames): void
    {
        DB::transaction(function () use ($groupId, $itemNames) {
            // Delete existing items
            MenuPriceGroupItem::where('menu_price_group_id', $groupId)->delete();

            // Create new items
            foreach ($itemNames as $index => $itemName) {
                if (trim($itemName) === '') {
                    continue;
                }

                MenuPriceGroupItem::create([
                    'menu_price_group_id' => $groupId,
                    'item_name' => trim($itemName),
                    'sort_order' => $index + 1,
                ]);
            }
        });
    }

    /**
     * Add item to a price group.
     *
     * @param string $groupId
     * @param string $itemName
     * @return void
     */
    public function addItem(string $groupId, string $itemName): void
    {
        $maxOrder = MenuPriceGroupItem::where('menu_price_group_id', $groupId)
            ->max('sort_order') ?? 0;

        MenuPriceGroupItem::create([
            'menu_price_group_id' => $groupId,
            'item_name' => trim($itemName),
            'sort_order' => $maxOrder + 1,
        ]);
    }

    /**
     * Remove item from a price group.
     *
     * @param string $itemId
     * @return bool
     */
    public function removeItem(string $itemId): bool
    {
        $item = MenuPriceGroupItem::find($itemId);

        if (!$item) {
            return false;
        }

        return $item->delete();
    }

    /**
     * Reorder price groups within a category.
     *
     * @param array $orderedIds Array of IDs in desired order
     * @return void
     */
    public function reorder(array $orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            MenuPriceGroup::where('id', $id)->update(['sort_order' => $index + 1]);
        }
    }
}
