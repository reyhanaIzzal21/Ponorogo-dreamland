<?php

namespace App\Contracts\Interfaces;

use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Collection;

interface MenuCategoryRepositoryInterface
{
    /**
     * Get all categories.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all active categories ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection;

    /**
     * Get all active categories with eager loaded items/price groups.
     *
     * @return Collection
     */
    public function getActiveWithItems(): Collection;

    /**
     * Find category by ID.
     *
     * @param string $id
     * @return MenuCategory|null
     */
    public function findById(string $id): ?MenuCategory;

    /**
     * Find category by slug.
     *
     * @param string $slug
     * @return MenuCategory|null
     */
    public function findBySlug(string $slug): ?MenuCategory;

    /**
     * Create a new category.
     *
     * @param array $data
     * @return MenuCategory
     */
    public function create(array $data): MenuCategory;

    /**
     * Update a category.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete a category.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Reorder categories.
     *
     * @param array $orderedIds Array of IDs in desired order
     * @return void
     */
    public function reorder(array $orderedIds): void;
}
