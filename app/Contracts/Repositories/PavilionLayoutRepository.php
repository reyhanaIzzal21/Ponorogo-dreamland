<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\PavilionLayoutRepositoryInterface;
use App\Models\PavilionLayout;
use Illuminate\Database\Eloquent\Collection;

class PavilionLayoutRepository implements PavilionLayoutRepositoryInterface
{
    /**
     * Get all layouts.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return PavilionLayout::ordered()->get();
    }

    /**
     * Get all active layouts ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return PavilionLayout::active()->ordered()->get();
    }

    /**
     * Find layout by ID.
     *
     * @param string $id
     * @return PavilionLayout|null
     */
    public function findById(string $id): ?PavilionLayout
    {
        return PavilionLayout::find($id);
    }

    /**
     * Create a new layout.
     *
     * @param array $data
     * @return PavilionLayout
     */
    public function create(array $data): PavilionLayout
    {
        if (!isset($data['sort_order'])) {
            $maxOrder = PavilionLayout::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return PavilionLayout::create($data);
    }

    /**
     * Update a layout.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $layout = $this->findById($id);

        if (!$layout) {
            return false;
        }

        return $layout->update($data);
    }

    /**
     * Delete a layout.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $layout = $this->findById($id);

        if (!$layout) {
            return false;
        }

        return $layout->delete();
    }

    /**
     * Get count of active layouts.
     *
     * @return int
     */
    public function getActiveCount(): int
    {
        return PavilionLayout::active()->count();
    }
}
