<?php

namespace App\Contracts\Interfaces;

use App\Models\MenuPriceGroup;
use Illuminate\Database\Eloquent\Collection;

interface MenuPriceGroupRepositoryInterface
{
    /**
     * Get all price groups for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getByCategoryId(string $categoryId): Collection;

    /**
     * Get price groups with items for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getByCategoryIdWithItems(string $categoryId): Collection;

    /**
     * Find price group by ID.
     *
     * @param string $id
     * @return MenuPriceGroup|null
     */
    public function findById(string $id): ?MenuPriceGroup;

    /**
     * Find price group by ID with items.
     *
     * @param string $id
     * @return MenuPriceGroup|null
     */
    public function findByIdWithItems(string $id): ?MenuPriceGroup;

    /**
     * Create a new price group.
     *
     * @param array $data
     * @return MenuPriceGroup
     */
    public function create(array $data): MenuPriceGroup;

    /**
     * Update a price group.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete a price group.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Sync items for a price group.
     *
     * @param string $groupId
     * @param array $itemNames Array of item names
     * @return void
     */
    public function syncItems(string $groupId, array $itemNames): void;

    /**
     * Add item to a price group.
     *
     * @param string $groupId
     * @param string $itemName
     * @return void
     */
    public function addItem(string $groupId, string $itemName): void;

    /**
     * Remove item from a price group.
     *
     * @param string $itemId
     * @return bool
     */
    public function removeItem(string $itemId): bool;

    /**
     * Reorder price groups within a category.
     *
     * @param array $orderedIds Array of IDs in desired order
     * @return void
     */
    public function reorder(array $orderedIds): void;
}
