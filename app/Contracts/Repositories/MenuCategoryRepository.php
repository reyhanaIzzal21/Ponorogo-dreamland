<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\MenuCategoryRepositoryInterface;
use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Collection;

class MenuCategoryRepository implements MenuCategoryRepositoryInterface
{
    /**
     * Get all categories.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return MenuCategory::orderBy('sort_order')->get();
    }

    /**
     * Get all active categories ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return MenuCategory::active()->ordered()->get();
    }

    /**
     * Get all active categories with eager loaded items/price groups.
     * Optimized query to prevent N+1 problem.
     *
     * @return Collection
     */
    public function getActiveWithItems(): Collection
    {
        return MenuCategory::active()
            ->ordered()
            ->with([
                'items' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('sort_order')
                        ->with('packageContents');
                },
                'priceGroups' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('sort_order')
                        ->with('items');
                },
            ])
            ->get();
    }

    /**
     * Find category by ID.
     *
     * @param string $id
     * @return MenuCategory|null
     */
    public function findById(string $id): ?MenuCategory
    {
        return MenuCategory::find($id);
    }

    /**
     * Find category by slug.
     *
     * @param string $slug
     * @return MenuCategory|null
     */
    public function findBySlug(string $slug): ?MenuCategory
    {
        return MenuCategory::where('slug', $slug)->first();
    }

    /**
     * Create a new category.
     *
     * @param array $data
     * @return MenuCategory
     */
    public function create(array $data): MenuCategory
    {
        // Auto-generate sort_order if not provided
        if (!isset($data['sort_order'])) {
            $maxOrder = MenuCategory::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return MenuCategory::create($data);
    }

    /**
     * Update a category.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $category = $this->findById($id);

        if (!$category) {
            return false;
        }

        return $category->update($data);
    }

    /**
     * Delete a category.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $category = $this->findById($id);

        if (!$category) {
            return false;
        }

        return $category->delete();
    }

    /**
     * Reorder categories.
     *
     * @param array $orderedIds Array of IDs in desired order
     * @return void
     */
    public function reorder(array $orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            MenuCategory::where('id', $id)->update(['sort_order' => $index + 1]);
        }
    }
}
