<?php

namespace App\Contracts\Interfaces;

use App\Models\PavilionFacility;
use Illuminate\Database\Eloquent\Collection;

interface PavilionFacilityRepositoryInterface
{
    /**
     * Get all facilities.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all active facilities ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection;

    /**
     * Find facility by ID.
     *
     * @param string $id
     * @return PavilionFacility|null
     */
    public function findById(string $id): ?PavilionFacility;

    /**
     * Create a new facility.
     *
     * @param array $data
     * @return PavilionFacility
     */
    public function create(array $data): PavilionFacility;

    /**
     * Update a facility.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete a facility.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Get count of active facilities.
     *
     * @return int
     */
    public function getActiveCount(): int;

    /**
     * Bulk update facilities.
     *
     * @param array $facilities Array of [id => data] or [data] for new items
     * @return bool
     */
    public function bulkUpdate(array $facilities): bool;
}
