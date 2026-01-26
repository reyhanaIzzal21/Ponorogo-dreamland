<?php

namespace App\Contracts\Interfaces;

use App\Models\PavilionLayout;
use Illuminate\Database\Eloquent\Collection;

interface PavilionLayoutRepositoryInterface
{
    /**
     * Get all layouts.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all active layouts ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection;

    /**
     * Find layout by ID.
     *
     * @param string $id
     * @return PavilionLayout|null
     */
    public function findById(string $id): ?PavilionLayout;

    /**
     * Create a new layout.
     *
     * @param array $data
     * @return PavilionLayout
     */
    public function create(array $data): PavilionLayout;

    /**
     * Update a layout.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete a layout.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Get count of active layouts.
     *
     * @return int
     */
    public function getActiveCount(): int;
}
