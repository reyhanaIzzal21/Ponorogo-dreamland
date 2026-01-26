<?php

namespace App\Contracts\Interfaces;

use App\Models\MenuItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface MenuItemRepositoryInterface
{
    /**
     * Get all active menu items.
     *
     * @return Collection
     */
    public function getAllActive(): Collection;

    /**
     * Get all items for a category.
     *
     * @param string $categoryId
     * @return Collection
     */
    public function getByCategoryId(string $categoryId): Collection;

    /**
     * Get items for a category with pagination (lazy loading).
     *
     * @param string $categoryId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByCategoryIdPaginated(string $categoryId, int $perPage = 10): LengthAwarePaginator;

    /**
     * Find item by ID.
     *
     * @param string $id
     * @return MenuItem|null
     */
    public function findById(string $id): ?MenuItem;

    /**
     * Find item by ID with package contents.
     *
     * @param string $id
     * @return MenuItem|null
     */
    public function findByIdWithContents(string $id): ?MenuItem;

    /**
     * Create a new menu item.
     *
     * @param array $data
     * @return MenuItem
     */
    public function create(array $data): MenuItem;

    /**
     * Update a menu item.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete a menu item.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Sync package contents for an item.
     *
     * @param string $itemId
     * @param array $contents Array of content names
     * @return void
     */
    public function syncPackageContents(string $itemId, array $contents): void;

    /**
     * Reorder items within a category.
     *
     * @param array $orderedIds Array of IDs in desired order
     * @return void
     */
    public function reorder(array $orderedIds): void;
}
